<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeSeeder extends Seeder
{
    public function run()
    {
        $students = Student::pluck('id');
        $subjects = Subject::pluck('id');

        foreach ($students as $studentId) {
            foreach ($subjects as $subjectId) {
                Grade::create([
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'grade' => rand(1, 10),
                ]);
            }
        }
    }
}
