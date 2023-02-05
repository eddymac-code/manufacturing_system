<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@manuapp.test',
            'password' => Hash::make('123456')
        ]);

        DB::table('branches')->insert([
            'name' => 'Default',
            'description' => 'The default branch'
        ]);

        DB::table('branch_users')->insert([
            'branch_id' => 1,
            'user_id' => 1
        ]);
    }
}
