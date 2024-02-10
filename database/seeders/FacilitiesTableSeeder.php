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
                'description' => 'This facility offers a great indoor space for playing futsal in Ithari. Equipped with all the necessary amenities, it provides an exciting environment for futsal enthusiasts.',
                'location' => 'Ithari',
                'map_coordinates' => '26.67689774449555,87.27256679456335',
                'price_per_hour' => '800',
                'facility_type' => 'indoor',
                'opening_time' => '10:30:00',
                'closing_time' => '05:00:00',
                'contact_person' => 'Nischal Acharya',
                'contact_email' => 'Nischal060@gmail.com',
                'contact_phone' => '9806081469',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ranabhumi Futsal',
                'description' => 'Located in Damak, this indoor futsal facility offers a fantastic space for players. With a reasonable price per hour, it is an excellent choice for futsal lovers in the Damak area.',
                'location' => 'Damak',
                'map_coordinates' => '26.673170349627597,87.69740295829253',
                'price_per_hour' => '670',
                'facility_type' => 'indoor',
                'opening_time' => '10:30:00',
                'closing_time' => '05:00:00',
                'contact_person' => 'Nischal Acharya',
                'contact_email' => 'Nischal060@gmail.com',
                'contact_phone' => '9806081469',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kathmandu Futsal',
                'description' => 'Located in Kathmandu, this indoor futsal facility offers a fantastic space for players. With a reasonable price per hour, it is an excellent choice for futsal lovers in the Kathmandu area.',
                'location' => 'Kathmandu',
                'map_coordinates' => '27.704625146804098,85.31987571768697',
                'price_per_hour' => '840',
                'facility_type' => 'indoor',
                'opening_time' => '10:30:00',
                'closing_time' => '06:00:00',
                'contact_person' => 'Nischal Acharya',
                'contact_email' => 'Nischal060@gmail.com',
                'contact_phone' => '9806081469',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('facilities')->insert($facilities);
    }
}
