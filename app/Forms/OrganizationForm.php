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

		$this->setFormOption('template', 'organization/form');

		$country_region_options = ['a' => 'Aaa', 'b' => 'Bbb', 'c' => 'Ccc'];

		$this->add('name', 'text', [
			'label' => trans('organization.name'),
			'rules' => ['required', 'min:2'],
		]);

		$this->add('organization_address', 'form', [
			'class' => AddressForm::class,
			'label' => FALSE, // 'ORGANIZATION ADDRESS',
			'showLabel' => FALSE,
		]);

		$this->add('website', 'url', [
			'label' => trans('organization.website'),
			'rules' => ['url'],
		]);

		$this->add('client_since', 'date', [
			'label' => trans('organization.client_since'),
			'rules' => ['required', 'date_format:Y-m-d'],
		]);
		$this->add('client_until', 'date', [
			'label' => trans('organization.client_until'),
			'rules' => ['date_format:Y-m-d'],
		]);

		$this->add('billing_contact_person', 'text', [
			'label' => trans('organization.billing_contact_person'),
			'rules' => ['required', 'min:2'],
		]);

		$this->add('billing_address', 'form', [
			'class' => AddressForm::class,
			'label' => FALSE, // 'BILLING ADDRESS',
			'showLabel' => FALSE,
		]);

		$this->add('billing_email', 'email', [
			'label' => trans('organization.billing_email'),
			'rules' => ['email'],
		]);
		$this->add('billing_phone', 'tel', [
			'label' => trans('organization.billing_phone'),
			'rules' => ['required', 'tel'],
		]);

		$this->add('maximum_accounts', 'number', [
			'label' => trans('organization.maximum_accounts'),
			'rules' => ['required', 'min:0'],
			'default_value' => 1,
		]);

		$this->add('country_regions_form', 'choice', [
			'label' => trans('organization.country_regions'),
			'choices' => $country_region_options,
			'expanded' => TRUE,
			'multiple' => TRUE,
			'rules' => ['required'],
		]);

		$this->add('agreements', 'textarea', [
			'label' => trans('organization.agreements'),
		]);

		$this->add('logo', 'file', [
			'label' => $this->getModel() ? trans('organization.upload_new_logo') : trans('organization.logo'),
			'attr' => ['accept' => 'image/*'],
			'rules' => ['image', 'min_width:200', 'min_height:200', 'max:2000'],
		]);
	}

}
