<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = [
            ['user_id' => 1,'service_id' => 1,'status' => 1],//1 DataTable
            ['user_id' => 1,'service_id' => 2,'status' => 1],//2 SummerNote
            // ['user_id' => 1,'service_id' => 3,'status' => 1],//3 New Product
            // ['user_id' => 1,'service_id' => 4,'status' => 1],//4 Feature Product
            // ['user_id' => 1,'service_id' => 5,'status' => 1],//5 Best Selling Product
            ['user_id' => 1,'service_id' => 6,'status' => 1],//6 No Product Type
            ['user_id' => 1,'service_id' => 7,'status' => 1],//7 Order Status
            ['user_id' => 1,'service_id' => 8,'status' => 1], //8 color specefic
            // ['user_id' => 1,'service_id' => 9,'status' => 1], //9 size specefic
            // ['user_id' => 1,'service_id' => 10,'status' => 1], //10 no color and size
            // ['user_id' => 1,'service_id' => 11,'status' => 1], //11 Database Add To Cart
            // ['user_id' => 1,'service_id' => 12,'status' => 1], //12 LocalStorage Add To Cart
             ['user_id' => 1,'service_id' => 13,'status' => 1], //13 Excel
             ['user_id' => 1,'service_id' => 14,'status' => 1], //Review
            //  ['user_id' => 1,'service_id' => 15,'status' => 1], //15 Wishlist
             ['user_id' => 1,'service_id' => 16,'status' => 1], //16 Timer Product


        ];

        DB::table('site_settings')->insert($n);
    }
}
