<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Routing\Controller;

/**
 * @Controller(prefix="queries")
 * @Middleware("web")
 */
class QueriesController extends Controller {

	/**
	 * @Get("/join", as="join")
	 */
	public function getJoin() {
		$query = School::query();
		$query->join('users as u', function(JoinClause $join) {
			$join->on('u.id', 'schools.user_id');
			$join->whereNotNull('u.first_login');
			$join->whereRaw('date(u.first_login) between ? AND ?', ['a', 'b']);
		});

		$sql = $query->toSql();

		return view('index', [
			'content' => "<pre>$sql</pre>",
		]);
	}

	/**
	 * @Get("/select", as="select")
	 */
	public function getSelect() {
		$list = ['a', 'c'];

		$query = School::query();
		$query->select(['*']);

		// $query->selectSub(function(Builder $query) use ($list) {
		// 	$query->whereIn('sector1', $list);
		// }, 'm1a');

		$query->selectRaw('(sector1 IN (?)) as m1b', [$list]);

		$query->selectRaw('(sector1 IN (' . implode(',', array_fill(0, count($list), '?')) . ')) as m1c', [$list]);

		$query->whereIn('sector1', $list);

		$sql = $query->toSql();

		$results = $query->get()->toArray();

		return view('index', [
			'content' => "<pre>$sql</pre><pre>" . print_r($results, 1) . "</pre>",
		]);
	}

}
