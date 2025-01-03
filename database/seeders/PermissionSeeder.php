<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = [

            ['role_id' => 1,'feature_id' => 1,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //1 home
            ['role_id' => 1,'feature_id' => 2,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //2 category
            ['role_id' => 1,'feature_id' => 3,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //3 sub category
            ['role_id' => 1,'feature_id' => 4,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //4 slider image
            ['role_id' => 1,'feature_id' => 5,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //5 banner image
            ['role_id' => 1,'feature_id' => 6,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //6 shipping
            ['role_id' => 1,'feature_id' => 7,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //7 brand
            ['role_id' => 1,'feature_id' => 8,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //8 order
            ['role_id' => 1,'feature_id' => 9,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //9 order status
            ['role_id' => 1,'feature_id' => 10,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //10 payment system
            ['role_id' => 1,'feature_id' => 11,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //11 customer contact
            ['role_id' => 1,'feature_id' => 12,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //12 site info
            ['role_id' => 1,'feature_id' => 13,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //13 user management
            ['role_id' => 1,'feature_id' => 14,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //14 role
            ['role_id' => 1,'feature_id' => 15,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //15 user creation
            ['role_id' => 1,'feature_id' => 16,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //16 product
            ['role_id' => 1,'feature_id' => 17,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //17 images
            ['role_id' => 1,'feature_id' => 18,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //18 setting
            ['role_id' => 1,'feature_id' => 19,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //19 setup
            ['role_id' => 1,'feature_id' => 20,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //20 features
            ['role_id' => 1,'feature_id' => 21,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //21 site setting
            ['role_id' => 1,'feature_id' => 22,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //22 main keys
            ['role_id' => 1,'feature_id' => 23,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //23 services
            ['role_id' => 1,'feature_id' => 24,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //24 setting setup
            ['role_id' => 1,'feature_id' => 25,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //25 setup size
            ['role_id' => 1,'feature_id' => 26,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //26 setup color
            ['role_id' => 1,'feature_id' => 27,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //27 pixel tag
            ['role_id' => 1,'feature_id' => 28,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //28 google tag
            ['role_id' => 1,'feature_id' => 29,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //29 page
            ['role_id' => 1,'feature_id' => 30,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //30 blog
            ['role_id' => 1,'feature_id' => 31,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //31 product shipping

                //super admin
                ['role_id' => 2,'feature_id' => 1,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //1 home
                // ['role_id' => 2,'feature_id' => 2,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //2 category
                // ['role_id' => 2,'feature_id' => 3,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //3 sub category
                ['role_id' => 2,'feature_id' => 4,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //4 slider image
                // ['role_id' => 2,'feature_id' => 5,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //5 banner image
                ['role_id' => 2,'feature_id' => 6,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //6 shipping
                // ['role_id' => 2,'feature_id' => 7,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //7 brand
                ['role_id' => 2,'feature_id' => 8,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //8 order
                ['role_id' => 2,'feature_id' => 9,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //9 order status
                // ['role_id' => 2,'feature_id' => 10,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //10 payment system
                // ['role_id' => 2,'feature_id' => 11,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //11 customer contact
                ['role_id' => 2,'feature_id' => 12,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //12 site info
                // ['role_id' => 2,'feature_id' => 13,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //13 user management
                // ['role_id' => 2,'feature_id' => 14,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //14 role
                // ['role_id' => 2,'feature_id' => 15,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //15 user creation
                ['role_id' => 2,'feature_id' => 16,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //16 product
                ['role_id' => 2,'feature_id' => 17,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //17 images
                ['role_id' => 2,'feature_id' => 18,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //18 setting
                // ['role_id' => 2,'feature_id' => 19,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //19 setup
                // ['role_id' => 2,'feature_id' => 20,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //20 features
                // ['role_id' => 2,'feature_id' => 21,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //21 site setting
                // ['role_id' => 2,'feature_id' => 22,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //22 main keys
                // ['role_id' => 2,'feature_id' => 23,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //23 services
                // ['role_id' => 2,'feature_id' => 24,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //24 setting setup
                // ['role_id' => 2,'feature_id' => 25,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //25 setup size
                // ['role_id' => 2,'feature_id' => 26,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //26 setup color
                ['role_id' => 2,'feature_id' => 27,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //27 pixel tag
                ['role_id' => 2,'feature_id' => 28,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //28 google tag
                // ['role_id' => 2,'feature_id' => 29,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //29 page
                // ['role_id' => 2,'feature_id' => 30,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //30 blog
                // ['role_id' => 2,'feature_id' => 31,'add' => '1','show' => '2','edit' => '3','delete' => '4'], //31 product shipping
            ];

            DB::table('permissions')->insert($n);

    }
}
