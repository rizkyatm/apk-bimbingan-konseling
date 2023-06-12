<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PetaKerawananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'sering sakit',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'sering ijin',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'sering alpha',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'sering terlambat',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'bolos',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'kelainan jasmani',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'minat/motivasi belajar kurang',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'introvert / pendiam',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'Tinggal dengan wali ',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'Kemampuan kurang',
        ]);
        DB::table('petakerawanan')->insert([
            'jenispetakerawanan' => 'Berkelahi',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Menantang guru',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Mengganggu temen',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Pacaran',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Broken Home',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Kondisi ekonomi kurang',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Pergaulan diluar sekolah ',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Penggunaan narkoba',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Merokok',
        ]);
        DB::table('Petakerawanan')->insert([
            'jenispetakerawanan' => 'Membiayai sekolah sendiri / bekerja',
        ]);
    }
}
