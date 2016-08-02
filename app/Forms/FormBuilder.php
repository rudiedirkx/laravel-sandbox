<?php

namespace App\Forms;

class FormBuilder extends \Kris\LaravelFormBuilder\FormBuilder {

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
			$form->add('submit', 'submit');
		}

		return $form;
	}

}