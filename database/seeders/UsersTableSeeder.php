<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $admin = new User;
        $admin->username = 'adminsupermint';
        $admin->name = 'Adminbot Rollout';
        $admin->email = 'admin@devtest.com';
        $admin->shipping_streetaddress = '69 Nuts Street, #21-34';
        $admin->shipping_city = 'Singapore';
        $admin->shipping_postalcode = '666666';
        $admin->password = bcrypt('secret');
        $admin->is_admin = true;
        $admin->save();
        
        $testers = [
            [ 
                'username' => 'tester1'
                , 'name' => 'tester1'
                , 'email' => 'tester1_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '01 Test Street, #11-01'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666661'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
            ]
            , [
                'username' => 'tester2'
                , 'name' => 'tester2'
                , 'email' => 'tester2_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '02 Test Street, #11-02'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666662'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
            ]
            , [
                'username' => 'tester3'
                , 'name' => 'tester3'
                , 'email' => 'tester3_vptcoder@gbuytest.com'
                , 'shipping_streetaddress' => '03 Test Street, #11-03'
                , 'shipping_city' => 'Singapore'
                , 'shipping_postalcode' => '666663'
                , 'password' => bcrypt('aacc12345')
                , 'is_admin' => false 
            ]
        ];

        DB::table('users')->insert($testers);        
    }
}
