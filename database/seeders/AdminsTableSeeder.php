<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Akun Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('123'),
        ]);
    }
}

// php artisan db:seed --class=AdminsTableSeeder