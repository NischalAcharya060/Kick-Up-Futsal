<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesTableSeeder extends Seeder
{
    public function run()
    {
        $facilities = [
            [
                'name' => 'Pathivara Futsal',
                'description' => 'Description for Futsal Facility 1',
                'location' => 'Ithari',
                'map_coordinates' => '26.6212405, 87.1576061',
                'image_path' => 'img/futsal_image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ranabhumi Futsal',
                'description' => 'Description for Futsal Facility 2',
                'location' => 'Damak',
                'map_coordinates' => '26.6502526, 87.6883885',
                'image_path' => 'img/futsal_image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('facilities')->insert($facilities);
    }
}
