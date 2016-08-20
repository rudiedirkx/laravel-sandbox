<?php

namespace App\Forms;

use App\Forms\AddressForm;
use Kris\LaravelFormBuilder\Form;

class SchoolForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$this->add('name', 'text', [
			'rules' => ['required'],
		]);
		$this->add('aliases', 'collection', [
			'type' => 'text',
			'options' => [
				'label' => 'Alias',
				'rules' => ['min:2', 'max:5'],
			],
			'rules' => ['required', 'min:1'],
		]);
		$this->add('locations', 'collection', [
			'type' => 'form',
			'options' => [
				'class' => AddressForm::class,
				'label' => 'Location',
			],
			// 'data' => [],
		]);
	}

}
