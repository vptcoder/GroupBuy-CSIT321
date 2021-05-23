<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		date_default_timezone_set('Asia/Singapore');

        $admin = new User;
        $admin->username = 'adminsupermint';
        $admin->name = 'Adminbot Rollout';
        $admin->email = 'admin@devtest.com';
        $admin->shipping_streetaddress = '69 Nuts Street, #21-34';
        $admin->shipping_city = 'Singapore';
        $admin->shipping_postalcode = '666666';
        $admin->password = bcrypt('randomyomamajoke');
        $admin->is_admin = true;
        $admin->created_at = Carbon::now();
        $admin->save();
        
        $testers = [
            [ 
                'username' => 'Lim Xin Rou'
                , 'name' => 'limxr'
                , 'email' => 'tester1_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '01 Test Street, #11-01'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666661'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Ernest Goh'
                , 'name' => 'earnestalphaboi'
                , 'email' => 'tester2_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '02 Test Street, #11-02'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666662'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Yang Sean'
                , 'name' => 'yangss'
                , 'email' => 'tester3_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '03 Test Street, #11-03'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666663'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Goh Lou Yang'
                , 'name' => 'gohly'
                , 'email' => 'tester4_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '03 Simin Street, #7-13'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '667113'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Ang Ding Wan'
                , 'name' => 'angdw'
                , 'email' => 'tester5_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '04 Simin Street, #5-10'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '664510'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Cheok Jia Xin'
                , 'name' => 'cheokjx'
                , 'email' => 'tester6_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '10 How Sun Drive, #2-28'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '510520'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Albert Brand'
                , 'name' => 'alboy22'
                , 'email' => 'tester7_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '11 Keong Saik Drive,'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '544511'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
            , [
                'username' => 'Emily Whitehead'
                , 'name' => 'whitequeen'
                , 'email' => 'tester8_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '8 Tampines Street, #20-05'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '628225'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
                , 'created_at' => Carbon::now(),
            ]
        ];

        DB::table('users')->insert($testers);        
    }
}
