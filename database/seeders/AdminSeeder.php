<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();
        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'username'             => "Admin",
                'email'                 => "admin@master.com",

                'password'              => bcrypt("123456"),
                'role_id'              => 1,
            ]
        ]);
    }
}
