<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ])->assignRole('Admin');
        User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
            'password' => Hash::make('password')
        ])->assignRole('inspector de obra');
        User::factory()->create([
            'name' => 'Test User3',
            'email' => 'test3@example.com',
            'password' => Hash::make('password')
        ])->assignRole('lector');
        //
    }
}
