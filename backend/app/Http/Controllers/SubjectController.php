<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $groups = Subject::all();
        return response()->json($groups);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Subject_name' => 'required|max:255',
        ]);

        $group = Subject::create($validatedData);

        return response()->json($group, 201);
    }

    public function show($id)
    {
        $group = Subject::findOrFail($id);
        return response()->json($group);
    }

    public function update(Request $request, $id)
    {
        $group = Subject::findOrFail($id);

        $validatedData = $request->validate([
            'Subject_name' => 'required|max:255',
        ]);

        $group->update($validatedData);

        return response()->json($group);
    }

    public function destroy($id)
    {
        $group = Subject::findOrFail($id);
        $group->delete();

        return response()->json(null, 204);
    }
}
