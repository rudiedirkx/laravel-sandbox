<?php

namespace App\Forms;

use App\InvoiceItem;
use Kris\LaravelFormBuilder\Form;

class InvoiceForm extends Form {

	public function buildForm() {
		$this->add('title', 'text', [
			'label' => 'Title',
		]);

		$this->add('items', 'collection', [
			'label' => 'Items',
			'type' => 'form',
			// 'data' => $this->model->items->push(new InvoiceItem(['x' => 'y'])),
			'prototype' => false,
			'empty_row' => new InvoiceItem(['invoice' => $this->model]),
			'options' => [
				'class' => InvoiceItemForm::class,
				'label' => false,
			],
		]);
	}

}
