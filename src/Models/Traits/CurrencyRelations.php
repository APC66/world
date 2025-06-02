<?php

namespace Apc66\World\Models\Traits;

use Apc66\World\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CurrencyRelations
{
	/**
	 * @return BelongsTo
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Models\Country::class);
	}
}
