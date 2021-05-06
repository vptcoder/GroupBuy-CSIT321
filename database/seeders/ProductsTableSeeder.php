<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'status' => "p11",
                'name' => "MEN'S BETTER THAN NAKED & JACKET",
                'description' => 'This is product 1\'s description. Short text',
                'min' => 5,
                'max' => 10,
                'price' => 200.10,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/mens-better-than-naked-jacket-AVMH_LC9_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => "WOMEN'S BETTER THAN NAKED™ JACKET",
                'description' => 'This is product 2\'s description. This text is longer',
                'min' => 5,
                'max' => 10,
                'price' => 1600.21,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/womens-better-than-naked-jacket-AVKL_NN4_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => "WOMEN'S SINGLE-TRACK SHOE",
                'description' => 'This is product 3\'s description. This text should be the longest of them all. 
                There is argument here. What shall this affect the page? Nobody knows!',
                'min' => 5,
                'max' => 10,
                'price' => 378.00,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/womens-single-track-shoe-ALQF_JM3_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'status' => "p01",
                'name' => 'Enduro Boa® Hydration Pack',
                'description' => 'This is product 4\'s description. This is extra',
                'min' => 5,
                'max' => 10,
                'price' => 21.10,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/enduro-boa-hydration-pack-AJQZ_JK3_hero.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ]
        ];

        DB::table('products')->insert($products);
    }
}
