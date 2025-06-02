<?php

namespace Apc66\World\Models;

use Apc66\World\Models\Traits\TimezoneRelations;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
	use TimezoneRelations;

	protected $fillable = [
		'country_id',
		'name',
	];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('world.migrations.timezones.table_name', parent::getTable());
	}
}
