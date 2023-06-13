<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GurusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gurus')->insert([
            'nip' => '654378864',
            'namaguru' => 'rara',
            'agama' => 'islam',
            'tempatlahir' => 'jakarta',
            'tanggallahir' => '19-02-03',
            'jeniskelamin' => 'perempuan',
            'email' => 'bk2@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}

// php artisan db:seed --class=GurusTableSeeder

