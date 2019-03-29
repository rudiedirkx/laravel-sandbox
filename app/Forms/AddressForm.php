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
			'label' => new HtmlString('The <em>Street</em> name'),
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
		if ($this->model && $this->model->picture_path) {
			$this->add('current_picture', 'static', [
				'value' => '<img width="100" src="' . $this->model->picture_path . '" />',
			]);
		}
		$this->add('picture', 'file', [

		]);
		if ($this->model && $this->model->terms_file) {
			$this->add('current_terms', 'static', [
				'value' => $this->model->terms->fullpath,
			]);
		}
		$this->add('terms', 'file', [

		]);
		$this->add('private', 'checkbox', [
			'label' => new HtmlString('Private address <em>(bla)</em>'),
		]);
	}

	/**
	 *
	 */
	public function alterFieldValues(array &$values) {
		$values['types'] = implode(',', (array) @$values['types']);

		$values['private'] = !empty($values['private']);

		foreach (['picture', 'terms'] as $field) {
			if ($values[$field] === null) {
				unset($values[$field]);
			}
		}
	}

}
