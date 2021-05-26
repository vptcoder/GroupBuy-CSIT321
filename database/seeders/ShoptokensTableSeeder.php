<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class ShoptokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		date_default_timezone_set('Asia/Singapore');
        $w = [
            [
                'user_id' => 2
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 3
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 4
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 5
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 6
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 7
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 3
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 4
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 5
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 4
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 5
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 5
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 6
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
            [
                'user_id' => 7
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ],
        ];

        DB::table('shoptokens')->insert($w);
    }
}
