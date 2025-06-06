<?php

namespace Apc66\World\Models;

use Apc66\World\Models\Traits\CityRelations;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	use CityRelations;

	protected $guarded = [];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('world.migrations.cities.table_name', parent::getTable());
	}
}
