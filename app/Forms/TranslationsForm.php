<?php

namespace App\Forms;

use App\Forms\TranslationForm;
use Kris\LaravelFormBuilder\Filters\FilterInterface;
use Kris\LaravelFormBuilder\Form;

class TranslationsForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

// dpm($this->model, 'TranslationsForm model');

		$collection = $this->data['collection'] ?? $this->model->translations1 ?? [];

		$this->add('log', 'text', [
			'label' => 'What changed?',
			'rules' => ['required'],
			'filters' => [new class implements FilterInterface {
				public function getName() {
					return 'upper';
				}
				public function filter($value, $options = []) {
					return strtoupper($value);
				}
			}],
		]);

		$this->add('lang[one]', 'select', [
			'label' => 'Whatever',
			'rules' => ['required'],
			'choices' => ['aaa' => 'Aaa', 'bbb' => 'Bbb'],
			'filters' => [new class implements FilterInterface {
				public function getName() {
					return 'upper';
				}
				public function filter($value, $options = []) {
					return strtoupper($value);
				}
			}],
		]);

		// Works
		$this->add('translations1', 'collection', [
			'label' => 'Vertalingen (1)',
			'type' => 'form',
			// 'data' => $collection,
			'prefer_input' => true,
			// 'empty_row' => false,
			'options' => [
				'class' => TranslationForm::class,
				'label' => false,
			],
		]);

		// Works
		// $this->add('translations2', 'collection', [
		// 	'label' => 'Vertalingen (2)',
		// 	'type' => 'text',
		// 	'property' => 'to',
		// 	'data' => $collection,
		// ]);

		// Doesn't work: every collection child renders collection[0]
		// $this->add('translations3', 'collection', [
		// 	'label' => 'Vertalingen (3)',
		// 	'type' => 'form',
		// 	'data' => $collection,
		// 	'options' => [
		// 		'class' => $this->formBuilder->plain()
		// 			->add('from', 'text', ['label' => 'From'])
		// 			->add('to', 'text', ['label' => 'To']),
		// 		'label' => 'Translation',
		// 	],
		// ]);

		// Works
		// $formObject = $this->formBuilder->create(TranslationForm::class);
		// $this->add('translations4', 'collection', [
		// 	'label' => 'Vertalingen (4)',
		// 	'type' => 'form',
		// 	'data' => $collection,
		// 	'options' => [
		// 		'class' => $formObject,
		// 		'label' => 'Translation',
		// 	],
		// ]);
	}

}
