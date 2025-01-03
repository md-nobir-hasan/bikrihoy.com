<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = [
            ['name' => 'KasetBD', 'title' => 'KasetBD', 'logo' => 'images/seeder/logo.png', 'address' => 'Mirpur,Dhaka'],
        ];
        $n2 = [
            ['phone' => '01786743293', 'whatsapp' => '01786743293', 'facebook_group_link' => '', 'email' => 'support@kasetbd.com'],
        ];

        DB::table('company_infos')->insert($n);
        DB::table('company_contacts')->insert($n2);
    }
}
