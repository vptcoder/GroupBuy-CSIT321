<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use DateTimeZone;
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
		$currentTime = new DateTime;
		$currentTime->setTimezone(new DateTimeZone(system('date +%z')));
		$dateEnd = clone($currentTime);
		$dateEnd->modify('+7 day');
		$groupbuy = [
			[
				'product_id' => 2
				, 'status' => "g11"
				, 'date_start' => $currentTime
				, 'date_end' => $dateEnd
				, 'min_required' => 5
				, 'max_available' => 10
				, 'started_by' => 2
				, 'date_success' => null
				, 'created_at' => $currentTime
				, 'updated_at' => null
			]
			, [
				'product_id' => 3
				, 'status' => "g11"
				, 'date_start' => $currentTime
				, 'date_end' => $dateEnd
				, 'min_required' => 5
				, 'max_available' => 10
				, 'started_by' => 3
				, 'date_success' => null
				, 'created_at' => $currentTime
				, 'updated_at' => null
			]
		];

        DB::table('groupbuys')->insert($groupbuy);
	}
}