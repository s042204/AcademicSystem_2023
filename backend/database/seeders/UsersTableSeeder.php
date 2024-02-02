<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'Jonas',
            'surname' => 'adminauskas',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'group_id' => null,
            'subject_id' => null,
        ]);
    }
}
