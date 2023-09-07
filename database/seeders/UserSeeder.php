<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create direktur user
        $direktur = User::create([
            'nip' => 1234,
            'name' => 'Doni',
            'email' => 'doni@mail.com',
            'password' => bcrypt('123456')
        ]);
        $direktur->assignRole('direktur');
        
        // create finance user
        $finance = User::create([
            'nip' => 1235,
            'name' => 'Dono',
            'email' => 'dono@mail.com',
            'password' => bcrypt('123456')
        ]);
        $finance->assignRole('finance');
        
        // create staff user
        $staff = User::create([
            'nip' => 1236,
            'name' => 'Dona',
            'email' => 'dona@mail.com',
            'password' => bcrypt('123456')
        ]);
        $staff->assignRole('staff');
    }
}
