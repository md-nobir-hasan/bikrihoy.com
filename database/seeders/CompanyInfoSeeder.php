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
            ['name' => 'Diaper', 'title' => 'Diaper', 'logo' => 'images/seeder/logo.png', 'address' => 'Mirpur,Dhaka'],
        ];
        $n2 = [
            ['phone' => '01896175583', 'whatsapp' => '+8801873385949', 'facebook_group_link' => '', 'email' => 'diaper@bikrihoy.com'],
        ];

        DB::table('company_infos')->insert($n);
        DB::table('company_contacts')->insert($n2);
    }
}
