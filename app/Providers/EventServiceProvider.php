<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

  /**
   * The subscriber classes to register.
   */
  protected $subscribe = [
    'App\Listeners\FormEventListener',
  ];

}
