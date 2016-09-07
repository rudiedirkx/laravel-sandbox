<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TranslationForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		// No model =(
		// dpm($this, 'this');

		$this->add('from', 'text', [
			'label' => 'From',
		]);

		$this->add('to', 'text', [
			'label' => 'To',
		]);
	}

}
