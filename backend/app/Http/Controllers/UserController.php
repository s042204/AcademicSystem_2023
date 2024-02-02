<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['groups', 'subject'])->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'password' => 'required',
            'role' => 'required|in:admin,teacher,student',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:groups,id',
            'subject_id' => 'nullable|exists:subjects,id'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if (isset($validatedData['group_ids'])) {
            $user->groups()->attach($validatedData['group_ids']);
        }

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::with(['groups', 'subject'])->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'password' => 'sometimes',
            'role' => 'required|in:admin,teacher,student',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:groups,id',
            'subject_id' => 'nullable|exists:subjects,id'
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        if (isset($validatedData['group_ids'])) {
            $user->groups()->sync($validatedData['group_ids']);
        }

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 204);
    }

    public function me(Request $request)
    {
        return $request->user()->load('groups', 'subject');
    }
}
