<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run()
    {
        Group::create(['group_name' => 'Group A']);
        Group::create(['group_name' => 'Group B']);
        Group::create(['group_name' => 'Group C']);
        Group::create(['group_name' => 'Group D']);
        Group::create(['group_name' => 'Group E']);
    }
}
