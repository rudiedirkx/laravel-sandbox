<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class InvoiceItemForm extends Form {

	public function buildForm() {
dump(get_class($this->model) . ' ' . $this->model->id);
		$this->setLanguageName('forms.invoice_item');

		$this->add('id', 'hidden', [
		]);

		$this->add('title', 'text', [
			// 'label' => 'Title',
		]);

		$this->add('related_people', 'collection', [
			'label' => 'Related people (' . count($this->model->related_people ?? []) . ')',
			'type' => 'form',
			'prototype' => false,
			'empty_row' => false,
			'options' => [
				'class' => InvoiceItemRelatedPersonForm::class,
				'label' => false,
			],
		]);

	}

}
