<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		date_default_timezone_set('Asia/Singapore');
        $orders = [
            [
                'groupbuy_id' => 1
                , 'product_id' => 2
                , 'user_id' => 2
                , 'status' => 'o11'
                , 'quantity' => 7
                , 'confirmedPrice' => 3200.42
                , 'shipping_streetaddress' => '01 Test Street, #11-01'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666661'
                , 'is_delivered' => false
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ]
            , [
                'groupbuy_id' => 1
                , 'product_id' => 2
                , 'user_id' => 2
                , 'status' => 'o11'
                , 'quantity' => 1
                , 'confirmedPrice' => 1600.21
                , 'shipping_streetaddress' => '01 Test Street, #11-01'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666661'
                , 'is_delivered' => false
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ]
            , [
                'groupbuy_id' => 2
                , 'product_id' => 3
                , 'user_id' => 3
                , 'status' => 'o11'
                , 'quantity' => 2
                , 'confirmedPrice' => 756.00
                , 'shipping_streetaddress' => '01 Test Street, #11-01'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666661'
                , 'is_delivered' => false
                , 'created_at' => Carbon::now()
                , 'updated_at' => null
            ]
        ];

        DB::table('orders')->insert($orders);
    }
}
