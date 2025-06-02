<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Apc66\World\Actions\SeedAction;

class WorldSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			SeedAction::class,
		]);
	}
}
