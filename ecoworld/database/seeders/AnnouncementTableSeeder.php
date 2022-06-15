<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('announcements')->insert([
            'author_id' => '1',
            'title' => 'Зробимо набережну чистою',
            'description' => "Візьміть воду з собою",
            'location' => 'м. Васильків, вул Зарічна',
            'date' => \DateTime::createFromFormat("d.m.Y G:i", "22.06.2022 16:00"),
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('announcements')->insert([
            'author_id' => '1',
            'title' => 'Нумо приберемо вулицю',
            'description' => "Візьміть воду та рукавички з собою",
            'location' => 'м. Васильків, вул Тракторна',
            'date' => \DateTime::createFromFormat("d.m.Y G:i", "24.06.2022 9:30"),
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('announcements')->insert([
            'author_id' => '1',
            'title' => 'Зробимо дворик більш чистим',
            'description' => "Візьміть воду, мішки та рукавички",
            'location' => 'м. Васильків, вул Декабристів',
            'date' => \DateTime::createFromFormat("d.m.Y G:i", "21.06.2022 10:40"),
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
