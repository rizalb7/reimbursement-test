<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'direktur',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'finance',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'staff',
            'guard_name' => 'web'
        ]);
    }
}
