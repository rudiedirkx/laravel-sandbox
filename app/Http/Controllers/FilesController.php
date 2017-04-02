<?php

namespace App\Http\Controllers;

use App\Address;
use App\Forms\AddressForm;
use App\Forms\FilesForm;
use App\Forms\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rdx\filemanager\FileId;
use rdx\filemanager\FileManager;
use rdx\filemanager\ManagedFile;
use rdx\filemanager\ModelFileId;

/**
 * @Controller(prefix="files")
 * @Middleware("web")
 */
class FilesController extends Controller {

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
				$managed = $files->saveFile($values[$field], 'ad/dr/es/ss');
				$files->publish('original', $managed);
				$usage[$field] = $managed;
				$values[$field] = $managed->id;
			}
		}

		// Save address
		$address = Address::create($values);

		// Save usages
		foreach ($usage as $field => $file) {
			$file->addUsage(new ModelFileId($address, $field));
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
	public function postEditAddress(FormBuilder $forms, $id) {
		$address = Address::findOrFail($id);
		$form = $forms->create(AddressForm::class, ['model' => $address]);
		$form->redirectIfNotValid();

		$values = $form->getFieldValues();
dpm($values, 'values');
	}



	/**
	 * @Get("/{managed_file}", as="files.show")
	 */
	public function getShowFile(Request $request, FormBuilder $forms, ManagedFile $file) {
dpm($file, 'file');
	}

	/**
	 * @Get("/create", as="files.create")
	 */
	public function getCreate(Request $request, FormBuilder $forms) {
		$form = $forms->create(FilesForm::class);

		return view('files/form', compact('form'));
	}

	/**
	 * @Post("/create", as="files.create.post")
	 */
	public function postCreate(Request $request, FormBuilder $forms, FileManager $files) {
		$form = $forms->create(FilesForm::class);
		$form->redirectIfNotValid();

// dpm($files, 'files');

		$values = $form->getFieldValues();
		$uploaded = $values['file1'];
// dpm($uploaded, 'file');

		$managed = $files->saveFile($uploaded)->addUsage(new FileId('files', 'create'));
dpm($managed, 'managed');
dpm($managed->fullpath, 'managed->fullpath');
	}

	/**
	 * @Get("/{publisher}/{managed_file_path}", priority=-20, as="files.publish")
	 */
	public function getPublishFile(Request $request, FileManager $files, $publisher, $path) {
		$file = $files->findByPathOrFail($path);
		$files->publish($publisher, $file);

		return redirect()->to($request->path());
	}

}
