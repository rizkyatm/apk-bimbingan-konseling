<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'AKUN ADMIN',
            'nisn_nip' => '321321',
            'level' => 'admin',
            'password' => bcrypt('123'),
        ]);
    }
}

// php artisan db:seed --class=UsersTableSeeder