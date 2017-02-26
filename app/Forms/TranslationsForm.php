<?php

namespace App\Forms;

use App\Forms\TranslationForm;
use Kris\LaravelFormBuilder\Form;

class TranslationsForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		// Works
		// $this->add('translations1', 'collection', [
		// 	'type' => 'form',
		// 	'data' => $this->data['collection'],
		// 	'options' => [
		// 		'class' => TranslationForm::class,
		// 		'label' => 'Translation',
		// 	],
		// ]);

		// Works
		// $this->add('translations2', 'collection', [
		// 	'type' => 'text',
		// 	'property' => 'to',
		// 	'data' => $this->data['collection'],
		// ]);

		// Doesn't work: every collection child renders collection[0]
		$this->add('translations3', 'collection', [
			'type' => 'form',
			'data' => $this->data['collection'],
			'options' => [
				'class' => $this->formBuilder->plain()
					->add('from', 'text', ['label' => 'From'])
					->add('to', 'text', ['label' => 'To']),
				'label' => 'Translation',
			],
		]);

		// Works
		// $formObject = $this->formBuilder->create(TranslationForm::class);
		// $this->add('translations4', 'collection', [
		// 	'type' => 'form',
		// 	'data' => $this->data['collection'],
		// 	'options' => [
		// 		'class' => $formObject,
		// 		'label' => 'Translation',
		// 	],
		// ]);
	}

}
