<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return response()->json($grades);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:1|max:10',
        ]);

        $grade = Grade::create($validatedData);

        return response()->json($grade->load(['student', 'subject']), 201);
    }

    public function show($id)
    {
        $grade = Grade::with(['student', 'subject'])->findOrFail($id);
        return response()->json($grade);
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);

        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:1|max:10',
        ]);

        $grade->update($validatedData);

        return response()->json($grade->load(['student', 'subject']));
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return response()->json(['message' => 'Grade deleted successfully'], 204);
    }
}
