<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return response()->json($groups);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'group_name' => 'required|max:255|unique:groups,group_name',
        ]);

        $group = Group::create($validatedData);

        return response()->json($group, 201);
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);
        return response()->json($group);
    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        $validatedData = $request->validate([
            'group_name' => 'required|max:255|unique:groups,group_name,' . $id,
        ]);

        $group->update($validatedData);

        return response()->json($group);
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);

        $group->delete();

        return response()->json(null, 204);
    }
}
