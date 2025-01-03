<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1 = Product
        //2 = Order
        //3 = USer
        //4 = Special
        //5 = Frontend
        $n = [
            ['name' => 'DataTable','main_key_id' => 4,'checking' => 1,'status' => 1], // 1
            ['name' => 'SummerNote','main_key_id' => 4,'checking' => 1,'status' => 1], // 2
            ['name' => 'New Product','main_key_id' => 1,'checking' => 7,'status' => 1], // 3
            ['name' => 'Feature Product','main_key_id' => 1,'checking' => 1,'status' => 1],
            ['name' => 'Best Selling Product','main_key_id' => 1,'checking' => 4,'status' => 1], // 5
            ['name' => 'No Product Type','main_key_id' => 1,'checking' => 4,'status' => 1], // 6
            ['name' => 'Order Status','main_key_id' => 2,'checking' => 4,'status' => 1], // 7
            ['name' => 'Color Specific','main_key_id' => 1,'checking' => 4,'status' => 1],
            ['name' => 'Size Specific','main_key_id' => 1,'checking' => 4,'status' => 1], // 9
            ['name' => 'No Color & Size','main_key_id' => 1,'checking' => 4,'status' => 1], // 10
            ['name' => 'Database Add To Cart','main_key_id' => 4,'checking' => 4,'status' => 1], // 11
            ['name' => 'LocalStorage Add To Cart','main_key_id' => 4,'checking' => 4,'status' => 1], // 12
            ['name' => 'Excel','main_key_id' => 2,'checking' => 4,'status' => 1], // 13
            ['name' => 'Review','main_key_id' => 5,'checking' => 1,'status' => 1], // 14
            ['name' => 'Wishlist','main_key_id' => 5,'checking' => 1,'status' => 1], // 15
            ['name' => 'Timer Product','main_key_id' => 1,'checking' => 1,'status' => 1], // 16
        ];

        DB::table('services')->insert($n);
    }
}
