<?php

namespace App\Http\Controllers;

use App\Forms\CreateOrganizationForm;
use App\Forms\FormBuilder;
use App\Forms\OrganizationForm;
use App\Forms\UserForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
	 * @Get("/organization", as="organization")
	 */
	public function getOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(OrganizationForm::class);

		return view('organization', compact('form'));
	}

	/**
	 * @Post("/organization", as="organization.post")
	 */
	public function postOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(OrganizationForm::class);

		echo '<pre>';
		print_r($request->all());
		var_dump($form->isValid());
	}



	/**
	 * @Get("/user", as="user")
	 */
	public function getUser(Request $request, FormBuilder $forms) {
		$form = $forms->create(UserForm::class);

		return view('user', compact('form'));
	}

	/**
	 * @Post("/user", as="user.post")
	 */
	public function postUser(Request $request, FormBuilder $forms) {
		$form = $forms->create(UserForm::class);

		echo '<pre>';
		print_r($request->all());
		var_dump($form->isValid());
	}



	/**
	 * @Get("/create-organization", as="organization.create")
	 */
	public function getCreateOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(CreateOrganizationForm::class);

		return view('create-organization', compact('form'));
	}

	/**
	 * @Post("/create-organization", as="organization.create.post")
	 */
	public function postCreateOrganization(Request $request, FormBuilder $forms) {
		$form = $forms->create(CreateOrganizationForm::class);

		echo '<pre>';
		print_r($request->all());
		var_dump($form->isValid());
	}

}
