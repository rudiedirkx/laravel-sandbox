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
	 * Getter for 'address'.
	 */
	public function getAddressAttribute() {
		return trim("$this->street $this->street_nr $this->street_nr_additional");
	}

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

	/**
	 * Convert 'types' to array
	 */
	public function fill(array $attributes) {
		$return = parent::fill($attributes);

		if (is_string($this->types)) {
			$this->types = array_filter(explode(',', $this->types));
		}

		return $return;
	}

	/**
	 * Convert 'types' to array
	 */
	public function setRawAttributes(array $attributes, $sync = false) {
		$return = parent::setRawAttributes($attributes, $sync);

		if (is_string($this->types)) {
			$this->types = array_filter(explode(',', $this->types));
		}

		return $return;
	}

	/**
	 * Convert 'types' to string
	 */
	public function save(array $options = []) {
		if (is_array($this->types)) {
			$this->types = implode(',', array_filter($this->types));
		}

		return parent::save($options);
	}

}
