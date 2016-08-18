<?php

namespace App\Forms;

use App\Forms\AddressForm;
use Kris\LaravelFormBuilder\Form;

class OrganizationForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$this->setFormOption('fields_template', 'organization/fields');

		$country_region_options = ['a' => 'Aaa', 'b' => 'Bbb', 'c' => 'Ccc'];

		$this->add('name', 'text', [
			'rules' => ['required', 'min:2'],
		]);

		$this->add('subscription', 'choice', [
			'choices' => [
				'' => '-- Select --',
				'a' => 'Aaa',
				'b' => 'Bbb',
			],
		]);

		$this->add('organization_address', 'form', [
			'class' => AddressForm::class,
			'label' => FALSE,
		]);

		$this->add('website', 'url', [
			'rules' => ['url'],
		]);

		$this->add('client_since', 'date', [
			'rules' => [
				'required_if:subscription,a,b',
				'required_if:organization.subscription,a,b',
				'date_format:Y-m-d',
			],
		]);
		$this->add('client_until', 'date', [
			'rules' => ['date_format:Y-m-d'],
		]);

		$this->add('billing_contact_person', 'text', [
			'rules' => ['required', 'min:2'],
		]);

		$this->add('billing_address', 'form', [
			'class' => AddressForm::class,
			'label' => FALSE,
		]);

		$this->add('billing_email', 'email', [
			'rules' => ['email'],
		]);
		$this->add('billing_phone', 'tel', [
			'rules' => ['required', 'tel'],
		]);

		$this->add('maximum_accounts', 'number', [
			'rules' => ['required', 'min:0'],
			'default_value' => 1,
		]);

		$this->add('country_regions_form', 'choice', [
			'choices' => $country_region_options,
			'expanded' => TRUE,
			'multiple' => TRUE,
			'rules' => ['required'],
		]);

		$this->add('agreements', 'textarea');

		$this->add('logo', 'file', [
			'attr' => ['accept' => 'image/*'],
			'rules' => ['image', 'min_width:200', 'min_height:200', 'max:2000'],
		]);
	}

}
