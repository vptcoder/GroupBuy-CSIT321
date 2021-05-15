<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;

class GroupbuysTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		date_default_timezone_set('Asia/Singapore');

		$currentTime = Carbon::now();
		$dateEnd1 = clone ($currentTime);
		$dateEnd1->addMinutes(3);

		$dateEnd2 = clone ($currentTime);
		$dateEnd2->addDays(7);

		$groupbuy = [
			[
				'product_id' => 2, 'status' => "g11", 'date_start' => $currentTime, 'date_end' => $dateEnd1, 'min_required' => 5, 'max_available' => 10, 'started_by' => 2, 'date_success' => null, 'created_at' => $currentTime, 'updated_at' => null
			], [
				'product_id' => 3, 'status' => "g11", 'date_start' => $currentTime, 'date_end' => $dateEnd2, 'min_required' => 5, 'max_available' => 10, 'started_by' => 3, 'date_success' => null, 'created_at' => $currentTime, 'updated_at' => null
			]
		];

		DB::table('groupbuys')->insert($groupbuy);
	}
}
