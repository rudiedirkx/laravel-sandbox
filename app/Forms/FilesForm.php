<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FilesForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$this->add('file1', 'file', [
			'rules' => ['required'],
		]);
	}

}
