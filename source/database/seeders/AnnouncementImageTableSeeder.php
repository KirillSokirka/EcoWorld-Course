<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('announcement_image')->insert([
            'image_id' => '3',
            'announcement_id' => '1',
        ]);
        \DB::table('announcement_image')->insert([
            'image_id' => '3',
            'announcement_id' => '1',
        ]);
        \DB::table('announcement_image')->insert([
            'image_id' => '9',
            'announcement_id' => '2',
        ]);
    }
}
