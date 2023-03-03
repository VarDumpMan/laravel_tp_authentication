<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("role_users")->insert([
            [
                "user_id" => 3,
                "role_id" => 2,
                "created_at" => now()
            ],
            [
                "user_id" => 2,
                "role_id" => 3,
                "created_at" => now()
            ],
        ]);
    }
}
