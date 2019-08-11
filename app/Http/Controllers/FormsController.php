<?php

namespace App\Http\Controllers;

use App\Address;
use App\Forms\AddressForm;
use App\Forms\CreateOrganizationForm;
use App\Forms\FormBuilder;
use App\Forms\InvoiceForm;
use App\Forms\NesterForm;
use App\Forms\OrganizationForm;
use App\Forms\SchoolForm;
use App\Forms\TranslationsForm;
use App\Forms\UserForm;
use App\Invoice;
use App\InvoiceItem;
use App\School;
use App\Translation;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\Form;
use rdx\filemanager\FileManager;

/**
 * @Middleware("web")
 */
class FormsController extends Controller {

	/**
	 * @Get("/files", as="files")
	 */
	public function getFiles(Request $request, FileManager $files) {
		$files = $files->findAll();

		return view('files/list', compact('files'));
	}



	/**
	 * @Get("/addresses", as="addresses")
	 */
	public function getAddresses() {
		$addresses = Address::all();

		return view('addresses/list', compact('addresses'));
	}

	/**
	 * @Get("/addresses/create", as="addresses.create")
	 */
	public function getCreateAddress(FormBuilder $forms) {
		$form = $forms->create(AddressForm::class);
		$form->disableFields();
		$address = null;

		return view('addresses/form', compact('address', 'form'));
	}

	/**
	 * @Post("/addresses/create", as="addresses.create.post")
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
	 * @Get("/addresses/{id}/edit", as="addresses.edit")
	 */
	public function getEditAddress(FormBuilder $forms, $id) {
		$address = Address::findOrFail($id);
		$form = $this->makeAddressForm($forms, $address);

		return view('addresses/form', compact('address', 'form'));
	}

	/**
	 * @Post("/addresses/{id}/edit", as="addresses.edit.post")
	 */
	public function postEditAddress(FormBuilder $forms, FileManager $files, $id) {
		$address = Address::findOrFail($id);
		$form = $this->makeAddressForm($forms, $address);
		$form->redirectIfNotValid();

		$values = $form->getFieldValues();

		foreach (['picture', 'terms'] as $field) {
			if (!empty($values[$field])) {
				$managed = $files->saveFile($values[$field], 'address');
				$managed->replaceUsage(new ModelFileUsage($address, $field));
				$values[$field] = $managed->id;
			}
		}

		$address->update($values);
		$files->cleanUsage();

		return redirect()->back();
	}

	protected function makeAddressForm(FormBuilder $forms, Address $address = null) {
		return $forms->create(AddressForm::class, [
			'model' => ['address' => $address],
			'name' => 'address',
		]);
	}

	/**
	 * @Get("/invoice", as="invoice")
	 */
	public function getInvoices(Request $request, FormBuilder $forms) {
		$invoice = new Invoice([
			'id' => 12,
			'title' => 'March 2019',
			'items' => collect([
				new InvoiceItem(['id' => 4, 'title' => 'Work']),
				new InvoiceItem(['id' => 5, 'title' => 'Lazying']),
			]),
		]);
		$form = $forms->create(InvoiceForm::class, [
			'model' => $invoice,
		]);

		return view('invoice.invoice', compact('form'));
	}



	/**
	 * @Get("/translate", as="translate")
	 */
	public function getTranslate(Request $request, FormBuilder $forms) {
		$translations = $this->translations();
		$model = (new School())->forceFill(['translations1' => $translations]);
		$form = $forms->create(TranslationsForm::class, [
			'model' => $model,
		], [
			// 'collection' => $translations,
		]);

		return view('translate.translate', compact('form'));
	}

	/**
	 * @Post("/translate", as="translate.post")
	 */
	public function postTranslate(Request $request, FormBuilder $forms) {
		$translations = $this->translations();
		$model = (new School())->forceFill(['translations1' => $translations]);
		$form = $forms->create(TranslationsForm::class, [
			// 'model' => $model,
		], [
			// 'collection' => $translations,
		]);

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
	}

	/**
	 *
	 */
	protected function translations() {
		return new ModelCollection([
			new Translation(['from' => 'Nederlands', 'to' => 'Dutch']),
			new Translation(['from' => 'Engels', 'to' => 'English']),
			// new Translation(['from' => 'Ja', 'to' => 'Yes']),
			// new Translation(['from' => 'Nee', 'to' => 'No']),
			// new Translation(['from' => 'Gisteren', 'to' => 'Yesterday']),
			// new Translation(['from' => 'Vandaag', 'to' => 'Today']),
			// new Translation(['from' => 'Morgen', 'to' => 'Tomorrow']),
			// new Translation(['from' => 'Maandag', 'to' => 'Monday']),
			// new Translation(['from' => 'Dinsdag', 'to' => 'Tuesday']),
			// new Translation(['from' => 'Woensdag', 'to' => 'Wednesday']),
			// new Translation(['from' => 'Donderdag', 'to' => 'Thursday']),
			// new Translation(['from' => 'Vrijdag', 'to' => 'Friday']),
			// new Translation(['from' => 'Zaterdag', 'to' => 'Saturday']),
			// new Translation(['from' => 'Zondag', 'to' => 'Sunday']),
		]);
	}



	/**
	 * @Get("/nested", as="nested")
	 */
	public function getNested(Request $request, FormBuilder $forms) {
		$form = $forms->create(NesterForm::class);

		return view('organization.organization', compact('form'));
	}

	/**
	 * @Post("/nested", as="nested.post")
	 */
	public function postNested(Request $request, FormBuilder $forms) {
		$form = $forms->create(NesterForm::class);

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
	}



	/**
	 * @Get("/organization", as="organization")
	 */
	public function getOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(OrganizationForm::class);

		return view('organization.organization', compact('form'));
	}

	/**
	 * @Post("/organization", as="organization.post")
	 */
	public function postOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(OrganizationForm::class);

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
	}



	/**
	 * @Get("/user", as="user")
	 */
	public function getUser(Request $request, FormBuilder $forms) {
		$form = $forms->create(UserForm::class);

		return view('user.user', compact('form'));
	}

	/**
	 * @Post("/user", as="user.post")
	 */
	public function postUser(Request $request, FormBuilder $forms) {
		$form = $forms->create(UserForm::class);

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
	}



	/**
	 * @Get("/create-organization", as="organization.create")
	 */
	public function getCreateOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(CreateOrganizationForm::class);

		return view('create-organization.create-organization', compact('form'));
	}

	/**
	 * @Post("/create-organization", as="organization.create.post")
	 */
	public function postCreateOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(CreateOrganizationForm::class);

dpm($form->getFieldValues(), 'values');
exit;

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
	}



	/**
	 * @Get("/school", as="school")
	 */
	public function getSchool(Request $request, FormBuilder $forms) {
		$school = $this->school();
// dpm($school, 'school');

		$form = $forms->create(SchoolForm::class, [
			'model' => $school,
		]);
// dpm($form, 'form');
// dpm($form->getRules(), 'rules');

		return view('school.school', compact('form'));
	}

	/**
	 * @Post("/school", as="school.post")
	 */
	public function postSchool(Request $request, FormBuilder $forms) {
		$form = $forms->create(SchoolForm::class);

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
	}

	/**
	 *
	 */
	protected function school() {
		$school = new School([
			'name' => 'ROCMN',
		]);

		return $school;
	}



	/**
	 *
	 */
	protected function handleSubmit(Request $request, Form $form) {
		echo '<pre>';
		print_r($request->all());
		print_r($form->getAllAttributes());
		print_r($form->getFieldValues());
		var_dump($form->isValid());
	}

}
