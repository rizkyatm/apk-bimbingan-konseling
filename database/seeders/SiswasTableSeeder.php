<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswas')->insert([
            'name' => 'muhammad rizky atmaja',
            'email' => 'riz@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}

// php artisan db:seed --class=siswasTableSeeder