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
			'label' => trans('user.email'),
			'rules' => ['required', 'email'],
		]);
		$this->add('firstname', 'text', [
			'label' => trans('user.firstname'),
			'rules' => ['required'],
		]);
		$this->add('middlename', 'text', [
			'label' => trans('user.middlename'),
		]);
		$this->add('lastname', 'text', [
			'label' => trans('user.lastname'),
			'rules' => ['required'],
		]);
		$this->add('phone', 'tel', [
			'label' => trans('user.phone'),
			'rules' => ['tel'],
		]);
		$this->add('country_region_id', 'choice', [
			'label' => trans('user.country_region'),
			'choices' => ['' => trans('user.select_country_region')] + $country_region_options,
			'rules' => ['required'],
		]);
		$this->add('nationality', 'choice', [
			'label' => trans('user.nationality'),
			'choices' => ['' => trans('user.select_nationality')] + $countries,
			'rules' => ['required'],
		]);
		$this->add('gender', 'choice', [
			'label' => trans('user.gender'),
			'choices' => ['m' => 'M', 'f' => 'F'],
			'expanded' => TRUE,
			'rules' => ['required'],
		]);
		$this->add('birthdate', 'date', [
			'label' => trans('user.birthdate'),
			'rules' => ['required', 'date_format:Y-m-d'],
		]);
		$this->add('education_level', 'text', [
			'label' => trans('user.education_level'),
		]);

		$this->add('picture', 'file', [
			'label' => trans('user.new_picture'),
			'attr' => ['accept' => 'image/*'],
			'rules' => ['image', 'min_width:200', 'min_height:200', 'max:2000'],
		]);
	}

}
