<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = [
            ['image'=>'images/default/slider/slider1.jpg'],
            ['image'=>'images/default/slider/slider2.jpg'],
            ['image'=>'images/default/slider/slider3.jpg'],
        ];

        DB::table('sliders')->insert($n);
    }
}
