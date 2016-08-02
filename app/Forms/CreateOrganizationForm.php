<?php

namespace App\Forms;

use App\Forms\OrganizationForm;
use App\Forms\UserForm;
use Kris\LaravelFormBuilder\Form;

class CreateOrganizationForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$this->add('organization', 'form', [
			'class' => OrganizationForm::class,
			'label' => 'Organization',
			'template' => 'organization/child_form',
		]);

		$this->add('manager', 'form', [
			'class' => UserForm::class,
			'label' => 'Manager',
		]);
	}

}
