<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use rdx\filemanager\FileManager;

class Address extends Model {

	protected $table = 'addresses';
	public $timestamps = false;
	protected $fillable = [
		'street',
		'street_nr',
		'street_nr_additional',
		'postal_code',
		'city',
		'country',
		'types',
		'picture',
		'terms',
		'private',
	];

	/**
	 * Getter for 'picture_file'.
	 */
	public function getPictureFileAttribute() {
		return app(FileManager::class)->find($this->picture);
	}

	/**
	 * Getter for 'picture_path'.
	 */
	public function getPicturePathAttribute() {
		if ($this->picture_file && file_exists($this->picture_file->fullpath)) {
			return $this->picture_file->webPath('small');
		}
	}

}
