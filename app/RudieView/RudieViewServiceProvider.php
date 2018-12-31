<?php

namespace App\RudieView;

use Illuminate\Support\ServiceProvider;

class RudieViewServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register() {
	}

	/**
	 * Bootstrap services.
	 */
	public function boot() {
		$this->app['view']->addExtension('rudie', 'rudie', function(...$args) {
			return new RudieEngine();
		});
	}

}
