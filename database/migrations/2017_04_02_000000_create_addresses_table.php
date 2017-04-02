<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up() {
		Schema::create('addresses', function(Blueprint $table) {
			$table->increments('id');
            $table->string('street')->default('');
            $table->string('street_nr')->default('');
            $table->string('street_nr_additional')->default('');
            $table->string('postal_code')->default('');
            $table->string('city')->default('');
            $table->string('country')->default('');
            $table->string('types')->default('');
            $table->integer('picture')->nullable()->unsigned()->index();
            $table->integer('terms')->nullable()->unsigned()->index();
            $table->boolean('private')->default(false);

			$table->foreign('picture')->references('id')->on('files');
			$table->foreign('terms')->references('id')->on('files');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() {
		Schema::table('addresses', function(Blueprint $table) {
			$table->drop();
		});
	}

}
