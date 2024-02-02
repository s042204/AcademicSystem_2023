<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Group;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $groups = Group::pluck('id');

        foreach (range(1, 10) as $index) {
            Student::create([
                'name' => "Student {$index}",
                'surname' => "Surname {$index}",
                'student_number' => "S{$index}",
                'group_id' => $groups->random(),
            ]);
        }
    }
}
