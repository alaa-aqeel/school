<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table("users")
            ->insert([
                "email" => "admin@email.com",
                "name"  => "admin",
                "password" => Hash::make("12345678"),
                "is_active" => 1,
                "is_super"  => 1
            ]);
    }
}
