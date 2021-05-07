<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ChoicesForm extends Form {

	public function buildForm() {
		$options = ['a' => 'Aaa', 'b' => 'Bbb', 'c' => 'Ccc'];
		$empty = ['' => '--'];

		$this->add('select', 'choice', [
			'choices' => $empty + $options,
			'expanded' => false,
			'multiple' => false,
			'rules' => ['required'],
		]);

		$this->add('bigselect', 'choice', [
			'choices' => $empty + $options,
			'expanded' => false,
			'multiple' => true,
			'rules' => ['required'],
		]);

		$this->add('radios', 'choice', [
			'choices' => $options,
			'expanded' => true,
			'multiple' => false,
			'rules' => ['required'],
		]);

		$this->add('checkboxes', 'choice', [
			'choices' => $options,
			'expanded' => true,
			'multiple' => true,
			'rules' => ['required'],
		]);
	}

}
