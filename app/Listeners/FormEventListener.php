<?php

namespace App\Listeners;

use Illuminate\Events\Dispatcher;
use Kris\LaravelFormBuilder\Events\AfterFieldCreation;
use Kris\LaravelFormBuilder\Events\AfterFormCreation;
use Kris\LaravelFormBuilder\Events\BeforeFormValidation;
use Kris\LaravelFormBuilder\Fields\FormField;
use Kris\LaravelFormBuilder\Form;

class FormEventListener {

  /**
   * After a FormField has been created.
   */
  public function onCreateFormField(AfterFieldCreation $event) {
    // dpm($event->getField(), 'field');
    if ($label = $event->getField()->getOption('label')) {
      // $event->getField()->setOption('label', 'x ' . $label);
    }
  }

  /**
   * After a Form has been created.
   */
  public function onCreateForm(AfterFormCreation $event) {
    // dpm($event->getForm(), 'form');
    // $event->getForm()->setFormOption('novalidate', '');
  }

  /**
   * After a Form has been validated.
   */
  public function onValidateForm(BeforeFormValidation $event) {
    // dpm($event->getValidator(), 'validator');
    // $validator = $event->getValidator();
    // $validator->after(function() use ($validator) {
    //   $validator->messages()->add('ass', 'face');
    // });
  }

  /**
   * Register the listeners for the subscriber.
   */
  public function subscribe(Dispatcher $events) {
    $events->listen(AfterFieldCreation::class, 'App\Listeners\FormEventListener@onCreateFormField');
    $events->listen(AfterFormCreation::class, 'App\Listeners\FormEventListener@onCreateForm');
    $events->listen(BeforeFormValidation::class, 'App\Listeners\FormEventListener@onValidateForm');
  }

}
