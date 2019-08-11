<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * @Middleware("web")
 */
class HomeController extends Controller {

	/**
	 * @Get("/", as="home")
	 */
	public function getIndex(Request $request) {
		return view('layout', [
			'content' => 'Woop woop ' . rand(),
			'list' => ['A', 'Bb', 'Ccc'],
		]);
	}

}
