<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->username = 'adminsupermint';
        $user->name = 'Adminbot Rollout';
        $user->email = 'admin@devtest.com';
        $user->shipphing_streetaddress = '69 Nuts Street, #21-34';
        $user->shipphing_city = 'Singapore';
        $user->shipphing_postalcode = '666666';
        $user->password = bcrypt('secret');
        $user->is_admin = true;
        $user->save();
    }
}
