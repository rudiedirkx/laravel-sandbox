<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AddressForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		$countries = ['a' => 'Aaa', 'b' => 'Bbb', 'c' => 'Ccc'];

		$this->add('street', 'text', [
			'label' => trans('address.street'),
			'rules' => ['required', 'min:2'],
		]);
		$this->add('street_nr', 'text', [
			'label' => trans('address.street_nr'),
			'rules' => ['required'],
		]);
		$this->add('street_nr_additional', 'text', [
			'label' => trans('address.street_nr_additional'),
		]);
		$this->add('postal_code', 'text', [
			'label' => trans('address.postal_code'),
		]);
		$this->add('city', 'text', [
			'label' => trans('address.city'),
			'rules' => ['required', 'min:2'],
		]);
		$this->add('country', 'choice', [
			'label' => trans('address.country'),
			'choices' => ['' => trans('address.select_country')] + $countries,
			'default_value' => 'NL',
			'rules' => ['required'],
		]);
	}

}
