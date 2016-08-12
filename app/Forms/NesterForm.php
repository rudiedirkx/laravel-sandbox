<?php

namespace App\Forms;

use App\Forms\NestedForm;
use Kris\LaravelFormBuilder\Form;

class NesterForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$this->add($this->formHelper->transformToBracketSyntax('nested.entity'), 'form', [
			'class' => NestedForm::class,
			'label' => 'Nested',
		]);

		$this->add($this->formHelper->transformToBracketSyntax('plain.form'), 'form', [
			'class' => $this->formBuilder->plain()->add('name[text]', 'text', [
				'label' => 'Text',
			]),
			'label' => 'Plain',
		]);
	}

}
