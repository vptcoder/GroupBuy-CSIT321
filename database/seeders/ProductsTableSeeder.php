<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
		date_default_timezone_set('Asia/Singapore');
        $products = [
            [
                'status' => "p11",
                'name' => "MEN'S BETTER THAN NAKED & JACKET",
                'description' => 'This is product 1\'s description. Short text',
                'min' => 5,
                'max' => 10,
                'price' => 200.00,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/mens-better-than-naked-jacket-AVMH_LC9_hero.png',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => "WOMEN'S BETTER THAN NAKED™ JACKET",
                'description' => 'This is product 2\'s description. This text is longer',
                'min' => 5,
                'max' => 10,
                'price' => 220.00,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/womens-better-than-naked-jacket-AVKL_NN4_hero.png',
                'created_at' => Carbon::now(),
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
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p01",
                'name' => 'Enduro Boa® Hydration Pack',
                'description' => 'This is product 4\'s description. This is extra',
                'min' => 5,
                'max' => 10,
                'price' => 21.00,
                'image' => 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/enduro-boa-hydration-pack-AJQZ_JK3_hero.png',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => 'Audio-Technica ATH-M50x',
                'description' => 'As the most critically acclaimed model in the M-Series line, 
                the ATH-M50 is praised by top audio engineers and pro audio reviewers year after year. 
                Now, the ATH-M50x professional monitor headphones feature the same coveted sonic signature, 
                with the added feature of detachable cables. 
                From the large aperture drivers, 
                sound isolating earcups and robust construction, 
                the M50x provides an unmatched experience for the most critical audio professionals.',
                'min' => 10,
                'max' => 30,
                'price' => 180.00,
                'image' => 'http://127.0.0.1:8000/images/1621767383_ath-m50x_01a.png',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => 'TIMEMORE Chestnut C Manual Coffee Grinder',
                'description' => 'Balance Works | Practical Design | Smooth Grinding | Wide Range of Brewing | Aesthetic gift.',
                'min' => 15,
                'max' => 25,
                'price' => 90.00,
                'image' => 'http://127.0.0.1:8000/images/1621767830_41pJ8Odqz9L._AC_.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => 'Elgato 10GAM9901 Cam Link',
                'description' => 'Easily connect your DSLR, camcorder, or action Cam to your PC or Mac.
                Go live on any platform in no time thanks to ultra-low-latency technology.
                Broadcast in stunning quality up to 1080P60 or 4K at 30 FPS.
                Shoot and produce within your favorite tools; Real-Time Feedback.
                Record footage directly to your Hard drive without time restrictions.',
                'min' => 15,
                'max' => 25,
                'price' => 120.00,
                'image' => 'http://127.0.0.1:8000/images/1621768051_61pWBRbG98L._AC_SX679_.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => "Under Armour Men's Heathered Blitzing 3.0 Cap",
                'description' => 'UA Classic Fit features a pre curved visor & structured front panels that maintain shape with a low profile fit.
                Front panel backed with foam padding for added comfort.
                UA Microthread fabric uses re engineered fibers designed to give superior stretch & breathability.
                Built in HeatGear sweatband wicks away sweat to keep you cool & dry.
                Stretch construction provides a comfortable fit.',
                'min' => 15,
                'max' => 25,
                'price' => 35.00,
                'image' => 'http://127.0.0.1:8000/images/1621768330_710dCcZM1dL._AC_SL1000_.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => "Easton EASTON -12 TYPHOON Baseball Bat",
                'description' => 'Lightweight and durable ALX100TM Military Grade Alloy construction
                Cushioned 2. 2 mm Flex grip provides comfort in hands
                Concave end cap
                Certification: USA Baseball',
                'min' => 15,
                'max' => 25,
                'price' => 75.00,
                'image' => 'http://127.0.0.1:8000/images/1621768635_717roq83-nL._AC_SL1500_.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'status' => "p11",
                'name' => "Star Wars The Black Series Bo-Katan Kryze Toy 15-cm Scale",
                'description' => "BO-KATAN KRYZE: A gifted warrior, Bo-Katan Kryze is a legendary Mandalorian. She refused to align with the Empire’s occupation of Mandalore
                THE MANDALORIAN SERIES-INSPIRED DESIGN: Fans and collectors can imagine scenes from the Star Wars Galaxy with this premium Bo-Katan Kryze toy, inspired by the The Mandalorian live-action TV series on Disney Plus
                TV SERIES-BASED CHARACTER-INSPIRED ACCESSORIES: This Star Wars The Black Series action figure comes with 3 entertainment-inspired accessories that make great additions to any Star Wars collection
                PREMIUM ARTICULATION AND DETAILING: Star Wars fans and collectors can display this highly poseable, fully articulated figure, featuring premium deco, in their action figure and vehicle collection
                LOOK FOR OTHER FIGURES FROM A GALAXY FAR, FAR AWAY: Look for movie- and entertainment-inspired Star Wars The Black Series figures to build a Star Wars galaxy (Each sold separately. Subject to availability)
                ",
                'min' => 15,
                'max' => 25,
                'price' => 20.00,
                'image' => 'http://127.0.0.1:8000/images/1621768790_71Vut8HAcdL._AC_SL1500_.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
