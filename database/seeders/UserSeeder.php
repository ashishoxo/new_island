<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('admins')->insert([
            'first_name' => \Str::random(10),
            'last_name' => \Str::random(10),
            'username' => 'admin123',
            'email' => 'admin@newisland.com',
            'password' => \Hash::make('Welkom2020!'),
        ]);
    }
}
