<?php

namespace App\Forms;

use Illuminate\Support\HtmlString;
use Kris\LaravelFormBuilder\Fields\ChoiceType;
use Kris\LaravelFormBuilder\Form;

class AddressForm extends Form {

	protected $clientValidationEnabled = false;

	/**
	 * Build the form.
	 */
	public function buildForm() {
		$model = $this->name ? $this->model[$this->name] ?? null : $this->model;

		$countries = [
			'a' => 'Aaa',
			'b' => 'Bbb',
			'c' => 'Ccc',
		];

		$this->add('street', 'text', [
			'label' => new HtmlString('The <em>Street</em> name'),
			'rules' => ['required'],
		]);
		$this->add('street_nr', 'text', [
			'rules' => [],
		]);
		// $this->add('street_nr_additional', 'text', [
		// ]);
		$this->add('postal_code', 'text', [
		]);
		$this->add('city', 'text', [
			'rules' => [],
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
			'multiple' => false,
			// 'copy_options_to_children' => false,
			'rules' => ['required'],
		]);
		// $this->addField(new ChoiceType('reservation', 'choice', $this, [
		// 	'label' => new HtmlString('Types <em>(36)</em>'),
		// 	'choices' => [
		// 		'a' => new HtmlString('Aaa <em>(12)</em>'),
		// 		'b' => new HtmlString('Bbb <em>(12)</em>'),
		// 		'c' => new HtmlString('Ccc <em>(12)</em>'),
		// 	],
		// 	'expanded' => true,
		// 	'multiple' => false,
		// 	'rules' => ['required'],
		// ]));
		if ($model && $model->picture_path) {
			$this->add('current_picture', 'static', [
				'value' => new HtmlString('<img width="100" src="' . $model->picture_path . '" />'),
				// 'tag' => 'img',
				// 'attr' => ['src' => $model->picture_path],
			]);
		}
		$this->add('picture', 'file', [

		]);
		if ($model && $model->terms_file) {
			$this->add('current_terms', 'static', [
				'value' => $model->terms->fullpath,
			]);
		}
		$this->add('terms', 'file', [

		]);
		$this->add('private', 'checkbox', [
			'label' => new HtmlString('Private address <em>(bla)</em>'),
			// 'value' => 'private',
		]);

		if ($this->name) {
			$this->add('submit', 'submit', [
				'label' => 'Su<em><strong>ubmi</strong></em>it',
				'attr' => ['value' => 'submit1'],
			]);
		}
	}

	/**
	 *
	 */
	public function alterFieldValues(array &$values) {
		// $values['types'] = implode(',', (array) @$values['types']);

		// $values['private'] = !empty($values['private']);

		foreach (['picture', 'terms'] as $field) {
			if ($values[$field] === null) {
				unset($values[$field]);
			}
		}
	}

}
