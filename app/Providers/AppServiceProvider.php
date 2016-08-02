<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 */
	public function register() {
		// $this->app->singleton('laravel-form-builder', function ($app) {
		// 	return new FormBuilder($app, $app['laravel-form-helper']);
		// });
	}

}
