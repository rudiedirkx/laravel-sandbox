<?php

namespace App\Forms;

use Illuminate\Support\HtmlString;
use Kris\LaravelFormBuilder\Form;

class AddressForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		$countries = [
			'a' => 'Aaa',
			'b' => 'Bbb',
			'c' => 'Ccc',
		];

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
		$this->add('types', 'choice', [
			'label' => new HtmlString('Types <em>(36)</em>'),
			'choices' => [
				'a' => new HtmlString('Aaa <em>(12)</em>'),
				'b' => new HtmlString('Bbb <em>(12)</em>'),
				'c' => new HtmlString('Ccc <em>(12)</em>'),
			],
			'expanded' => true,
			'multiple' => true,
		]);
		$this->add('private', 'checkbox', [
			'label' => new HtmlString('Private address <em>(bla)</em>'),
		]);
	}

	/**
	 *
	 */
	public function alterFieldValues(array &$values) {
		$values['types'] = (array) @$values['types'];
	}

	/**
	 *
	 */
	public function alterValid(Form $mainForm, &$isValid)
	{
		$values = $this->getFieldValues(false);

		if (strlen($values['street']) != 6) {
			$messages['street'][] = 'MUST BE EXACTLY 6 CHARS LONG!';
			return $messages;
		}
	}

}
