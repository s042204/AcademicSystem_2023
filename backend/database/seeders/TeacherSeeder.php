<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        DB::table('teachers')->insert([
            ['name' => 'MokytojVard', 'surname' => 'MokytojPav'],
        ]);
    }
}
