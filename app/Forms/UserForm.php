<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form {

	/**
	 * Build the form.
	 */
	public function buildForm() {
		parent::buildForm();

		$countries = ['a' => 'Aaa', 'b' => 'Bbb', 'c' => 'Ccc'];

		$country_region_options = ['a' => 'Aaa', 'b' => 'Bbb', 'c' => 'Ccc'];

		$this->add('email', 'email', [
			'rules' => ['required', 'email'],
		]);
		$this->add('firstname', 'text', [
			'rules' => ['required'],
		]);
		$this->add('middlename', 'text', [
		]);
		$this->add('lastname', 'text', [
			'rules' => ['required'],
		]);
		$this->add('phone', 'text');
		$this->add('country_region_id', 'choice', [
			'choices' => ['' => '-- Select region --'] + $country_region_options,
			'rules' => ['required'],
		]);
		$this->add('nationality', 'choice', [
			'choices' => ['' => '-- Select country --'] + $countries,
			'rules' => ['required'],
		]);
		$this->add('gender', 'choice', [
			'choices' => ['m' => 'M', 'f' => 'F'],
			'expanded' => TRUE,
			'rules' => ['required'],
		]);
		$this->add('birthdate', 'date', [
			'rules' => ['required', 'date_format:Y-m-d'],
		]);
		$this->add('education_level', 'text', [
		]);

		$this->add('picture', 'file', [
			'attr' => ['accept' => 'image/*'],
			'rules' => ['image', 'max:2000'],
		]);
	}

	/**
	 *
	 */
	public function alterValid(Form $mainForm, &$isValid)
	{
		$messages = [];

		if (!$isValid) {
			$values = $this->getFieldValues(false);
			if (!empty($values['picture'])) {
				$label = $this->getField('picture')->getOption('label');
				$messages['picture'] = "Must re-upload '$label', because validation errors.";
			}
		}

		return $messages;
	}

}
