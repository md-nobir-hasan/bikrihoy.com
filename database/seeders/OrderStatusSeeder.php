<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = [
            ['name' => 'new','status' => 'active'],
            ['name' => 'processing','status' => 'active'],
            ['name' => 'shipped','status' => 'active'],
            ['name' => 'delivered','status' => 'active'],
            ['name' => 'cancel','status' => 'active'],
        ];

        DB::table('order_statuses')->insert($n);
    }
}
