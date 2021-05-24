<?php

namespace Database\Seeders;

use App\Models\Groupbuy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
            GroupbuysTableSeeder::class,
            OrdersTableSeeder::class,
            WatchlistsTableSeeder::class,
        ]);
    }
}
