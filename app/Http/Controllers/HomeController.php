<?php

namespace App\Http\Controllers;

use App\Forms\CreateOrganizationForm;
use App\Forms\FormBuilder;
use App\Forms\NesterForm;
use App\Forms\OrganizationForm;
use App\Forms\UserForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;

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

		$form->redirectIfNotValid();

		$this->handleSubmit($request, $form);
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
