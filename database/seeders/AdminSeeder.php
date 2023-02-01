<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'supperadmin',
            'slug'=> 'super-admin',
            'email' => 'supperadmin@gmail.com',
            'password' => Hash::make('password'),
            'role' => '1',
            'status' => '1',
        ]);
    }
}
