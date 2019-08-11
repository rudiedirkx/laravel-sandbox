<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class InvoiceItemForm extends Form {

	public function buildForm() {
		$this->add('id', 'hidden', [
		]);

		$this->add('title', 'text', [
			// 'label' => 'Title',
		]);

	}

}
