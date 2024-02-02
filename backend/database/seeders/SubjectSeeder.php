<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('subjects')->insert([
            ['subject_name' => 'Mathematics'],
            ['subject_name' => 'Science'],
        ]);
    }
}
