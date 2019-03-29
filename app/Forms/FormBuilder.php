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
			// $form->setFormOption('novalidate', '');
			$form->add('submit', 'submit', [
				'label' => 'Su<em><strong>ubmi</strong></em>it',
				'attr' => ['value' => 'submit1'],
			]);
		}

		return $form;
	}

}
