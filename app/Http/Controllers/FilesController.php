<?php

namespace App\Http\Controllers;

use App\Address;
use App\Forms\AddressForm;
use App\Forms\FilesForm;
use App\Forms\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rdx\filemanager\FileUsage;
use rdx\filemanager\FileManager;
use rdx\filemanager\ManagedFile;
use rdx\filemanager\ModelFileUsage;

/**
 * @Controller(prefix="files")
 * @Middleware("web")
 */
class FilesController extends Controller {

	/**
	 * @Get("/", as="files")
	 */
	public function getFiles(Request $request, FileManager $files) {
		$files = $files->findAll();

		return view('files/list', compact('files'));
	}



	/**
	 * @Get("/addresses", as="files.addresses")
	 */
	public function getAddresses() {
		$addresses = Address::all();

		return view('files/addresses/list', compact('addresses'));
	}

	/**
	 * @Get("/addresses/create", as="files.addresses.create")
	 */
	public function getCreateAddress(FormBuilder $forms) {
		$form = $forms->create(AddressForm::class);
		$address = null;

		return view('files/addresses/form', compact('address', 'form'));
	}

	/**
	 * @Post("/addresses/create", as="files.addresses.create.post")
	 */
	public function postCreateAddress(FormBuilder $forms, FileManager $files) {
		$form = $forms->create(AddressForm::class);
		$form->redirectIfNotValid();

		$values = $form->getFieldValues();

		// Save files, remember usage
		$usage = [];
		foreach (['picture', 'terms'] as $field) {
			if (isset($values[$field])) {
				$managed = $files->saveFile($values[$field], 'address');
				$usage[$field] = $managed;
				$values[$field] = $managed->id;
			}
		}

		// Save address
		$address = Address::create($values);

		// Save usages
		foreach ($usage as $field => $file) {
			$file->addUsage(new ModelFileUsage($address, $field));
		}

		return redirect()->route('files.addresses');
	}

	/**
	 * @Get("/addresses/{id}/edit", as="files.addresses.edit")
	 */
	public function getEditAddress(FormBuilder $forms, $id) {
		$address = Address::findOrFail($id);
		$form = $forms->create(AddressForm::class, ['model' => $address]);

		return view('files/addresses/form', compact('address', 'form'));
	}

	/**
	 * @Post("/addresses/{id}/edit", as="files.addresses.edit.post")
	 */
	public function postEditAddress(FormBuilder $forms, FileManager $files, $id) {
		$address = Address::findOrFail($id);
		$form = $forms->create(AddressForm::class, ['model' => $address]);
		$form->redirectIfNotValid();

		$values = $form->getFieldValues();

		foreach (['picture', 'terms'] as $field) {
			if (isset($values[$field])) {
				$managed = $files->saveFile($values[$field], 'address');
				$managed->replaceUsage(new ModelFileUsage($address, $field));
				$values[$field] = $managed->id;
			}
		}

		$address->update($values);
		$files->cleanUsage();

		return redirect()->back();
	}

}
