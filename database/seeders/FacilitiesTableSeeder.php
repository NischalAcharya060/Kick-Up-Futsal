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
                'map_coordinates' => '26.67689774449555,87.27256679456335',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ranabhumi Futsal',
                'description' => 'Description for Futsal Facility 2',
                'location' => 'Damak',
                'map_coordinates' => '26.673170349627597,87.69740295829253',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('facilities')->insert($facilities);
    }
}
