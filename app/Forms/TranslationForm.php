<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Filters\FilterInterface;
use Kris\LaravelFormBuilder\Form;

class TranslationForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

// dpm($this->model, 'TranslationForm model');

		$this->add('from', 'text', [
			'label' => 'From',
		]);

		$this->add('to', 'text', [
			'label' => 'To',
			'filters' => [new class implements FilterInterface {
				public function getName() {
					return 'upper';
				}
				public function filter($value, $options = []) {
					return strtoupper($value);
				}
			}],
		]);
	}

}
