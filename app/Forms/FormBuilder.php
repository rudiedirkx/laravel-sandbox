<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\FormBuilder as BaseFormBuilder;

class FormBuilder extends BaseFormBuilder {

	/**
	 * Override Kris\LaravelFormBuilder\FormBuilder::create().
	 */
	public function create($formClass, array $options = [], array $data = []) {
		$options += [
			'method' => 'POST',
		];
		$form = parent::create($formClass, $options, $data);

		if (empty($options['name'])) {
			$form->setFormOption('novalidate', '');
			$form->add('submit', 'submit', ['value' => 'submit1']);
			// $form->add('submit2', 'submit', ['value' => 'submit2']);
		}

		return $form;
	}

}
