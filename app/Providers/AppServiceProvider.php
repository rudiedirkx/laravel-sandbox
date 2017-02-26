<?php

namespace App\Providers;

use App\Forms\BaseForm;
use App\Forms\FormBuilder;
use Illuminate\Support\ServiceProvider;
use Kris\LaravelFormBuilder\FormHelper;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register() {
		$this->app->singleton(FormBuilder::class, function ($app) {
			return new FormBuilder($app, $app[FormHelper::class], $app['events']);
		});

		$this->app->alias(FormBuilder::class, 'laravel-form-builder');
		$this->app->alias(FormBuilder::class, 'Kris\LaravelFormBuilder\FormBuilder');
	}

	/**
	 * Bootstrap services.
	 */
	public function boot() {
		$this->app->extend(FormBuilder::class, function($forms, $app) {
			$forms->setFormClass(BaseForm::class);
			return $forms;
		});
	}

}
