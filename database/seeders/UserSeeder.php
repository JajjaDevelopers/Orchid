<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            // 'name' => 'Admin',
            'first_name' => 'Kibooli',
            'last_name' => 'Felix',
            'email' => 'kiboolif@gmail.com',
            'password' => Hash::make('christosestinkalon'),
            'is_admin' => true,
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);
    }
}
