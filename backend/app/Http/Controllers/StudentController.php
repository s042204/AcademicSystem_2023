<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['group', 'grades.subject'])->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'student_number' => 'required|unique:students,student_number',
            'group_id' => 'required|exists:groups,id',
        ]);

        $student = Student::create($validatedData);

        $username = $validatedData['student_number'];

        User::create([
            'username' => $username,
            'password' => Hash::make($validatedData['surname']),
            'role' => 'student',
        ]);

        return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
    }

    public function show(Student $student)
    {
        return response()->json($student->load(['group', 'grades.subject']));
    }

    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'student_number' => 'required|unique:students,student_number,' . $student->id,
            'group_id' => 'required|exists:groups,id',
        ]);

        $student->update($validatedData);

        return response()->json(['message' => 'Student updated successfully', 'student' => $student]);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        User::where('username', $student->student_number)->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
