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
			'rules' => ['required', 'min:2'],
		]);
		$this->add('street_nr', 'text', [
			'rules' => ['required'],
		]);
		$this->add('street_nr_additional', 'text', [
		]);
		$this->add('postal_code', 'text', [
		]);
		$this->add('city', 'text', [
			'rules' => ['required', 'min:2'],
		]);
		$this->add('country', 'choice', [
			'choices' => ['' => '-- Select country --'] + $countries,
			'default_value' => 'a',
			'rules' => ['required'],
		]);
	}

}
