<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class InvoiceItemRelatedPersonForm extends Form {

	public function buildForm() {
dump(get_class($this->model) . ' ' . $this->model->id);
		$this->setLanguageName('forms.invoice_item_related_person');

		$this->add('id', 'hidden', [
		]);

		$this->add('name', 'text', [
			// 'label' => 'Name',
		]);
	}

}
