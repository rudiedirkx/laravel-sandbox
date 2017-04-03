<?php

namespace App\Http\Controllers;

use App\Forms\CreateOrganizationForm;
use App\Forms\FormBuilder;
use App\Forms\NesterForm;
use App\Forms\OrganizationForm;
use App\Forms\SchoolForm;
use App\Forms\TranslationsForm;
use App\Forms\UserForm;
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
class HomeController extends Controller {

	/**
	 * @Get("/", as="home")
	 */
	public function getIndex(Request $request) {
		return view('index', []);
	}



	/**
	 * @Get("/translate", as="translate")
	 */
	public function getTranslate(Request $request, FormBuilder $forms) {
		$translations = $this->translations();

		$form = $forms->create(TranslationsForm::class, [], [
			'collection' => $translations,
		]);

		return view('translate.translate', compact('form'));
	}

	/**
	 * @Post("/translate", as="translate.post")
	 */
	public function postTranslate(Request $request, FormBuilder $forms) {
		$form = $forms->create(TranslationsForm::class);

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
			new Translation(['from' => 'Ja', 'to' => 'Yes']),
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



	/**
	 * @Get("/_files/{publisher}/{managed_file_path}", as="files.publish")
	 */
	public function getPublishFile(Request $request, FileManager $files, $publisher, $path) {
		$file = $files->findByPathOrFail($path);
		$files->publish($publisher, $file);

		return redirect()->to($request->path());
	}

}
