<?php

namespace App\Forms;

use App\Address;
use App\InvoiceItem;
use Kris\LaravelFormBuilder\Form;

class InvoiceForm extends Form {

	public function buildForm() {
		// $this->setTranslationTemplate('Field `{name}`');
		$this->setLanguageName('forms.invoice');

		$this->add('title', 'text', [
			// 'label' => 'Title',
		]);

		$this->add('items', 'collection', [
			// 'label' => 'Items',
			'type' => 'form',
			'data' => $this->model->items->push(new InvoiceItem()),
			'prototype' => false,
			'empty_row' => new InvoiceItem(['invoice' => $this->model]),
			'options' => [
				'class' => InvoiceItemForm::class,
				'label' => false,
				'language_name' => 'forms.invoice_item',
			],
		]);

		$this->add('address_id', 'entity', [
			'class' => Address::class,
			'property' => function(Address $address) {
				return (string) $address->address;
			},
		]);
	}

}
