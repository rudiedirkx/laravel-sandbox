<?php

namespace App;

use App\Address;
use Illuminate\Database\Eloquent\Model;

class School extends Model {

    protected static $unguarded = true;

    public function __construct(array $attributes = []) {
    	parent::__construct($attributes);

    	$this->setRelation('locations', [
    		new Address(['street' => 'Some street']),
    		new Address(['street' => 'Another street']),
    	]);
    }

}
