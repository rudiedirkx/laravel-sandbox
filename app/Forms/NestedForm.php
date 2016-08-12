<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NestedForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$this->add($this->formHelper->transformToBracketSyntax('name.text'), 'text', [
			'label' => 'Name',
			'rules' => ['required'],
		]);
	}

}
