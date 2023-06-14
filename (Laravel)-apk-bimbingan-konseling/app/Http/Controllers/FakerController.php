<?php

namespace App\Http\Controllers;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FakerController extends Controller{
    public function GuruFakeData(){
        $faker = Faker::create();
        // Generate fake data for users, gurus, and wali_kelas tables
        for ($i = 1; $i <= 5; $i++) {
            $name = $faker->name;
            
            // Generate fake data for users table
            $userData = [
                'name' => $name,
                'nisn_nip' => $faker->unique()->numberBetween(1000, 9999),
                'level' => $faker->randomElement(['guru']),
                'password' => Hash::make('123')
            ];
            
            // Insert user data into the users table
            $userId = DB::table('users')->insertGetId($userData);
            
            // Generate fake data for gurus table
            $guruData = [
                'namaguru' => $name,
                'foto' => 'foto.png',
                'tempatlahir' => $faker->city,
                'tanggallahir' => $faker->date(),
                'jeniskelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'user_id' => $userId
            ];
            
            // Insert guru data into the gurus table
            DB::table('gurus')->insert($guruData);

        }
        
    }

    public function WalasFakeData(){
        $faker = Faker::create();
        // Generate fake data for users, gurus, and wali_kelas tables
        for ($i = 1; $i <= 10; $i++) {
            $name = $faker->name;
            
            // Generate fake data for users table
            $userData = [
                'name' => $name,
                'nisn_nip' => $faker->unique()->numberBetween(1000, 9999),
                'level' => $faker->randomElement(['wali_kelas']),
                'password' => Hash::make('123')
            ];
            
            // Insert user data into the users table
            $userId = DB::table('users')->insertGetId($userData);
            
            // Generate fake data for gurus table
            $guruData = [
                'namagurukelas' => $name,
                'foto' => 'foto.png',
                'tempatlahir' => $faker->city,
                'tanggallahir' => $faker->date(),
                'jeniskelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'user_id' => $userId
            ];
            
            // Insert guru data into the gurus table
            DB::table('wali_kelas')->insert($guruData);

        }
        
    }

    public function KelasFakeData(){
        $kelasData = [
            ['kelas' => '10 PPLG 1'],
            ['kelas' => '10 PPLG 2'],
            ['kelas' => '10 PPLG 3'],
            ['kelas' => '10 ANIMASI 1'],
            ['kelas' => '10 ANIMASI 2'],
            ['kelas' => '11 PPLG 1'],
            ['kelas' => '11 PPLG 2'],
            ['kelas' => '11 PPLG 3'],
            ['kelas' => '11 ANIMASI 1'],
            ['kelas' => '11 ANIMASI 2']
        ];
        
        $guruCount = 5; // Jumlah guru yang ada
        $walikelasCount = 10; // Jumlah wali kelas yang ada
        
        foreach ($kelasData as $index => $data) {
            $kelas = DB::table('kelas')->insertGetId($data);
            $guruId = ($index % $guruCount) + 1; // Assign guru_id secara berurutan
            $walikelasId = ($index % $walikelasCount) + 1; // Assign walikelas_id secara berurutan
        
            // Assign the guru_id and walikelas_id to the created kelas
            DB::table('kelas')->where('id', $kelas)->update(['guru_id' => $guruId, 'walikelas_id' => $walikelasId]);
        }
    }

    public function SiswaFakeData(){
        $faker = Faker::create();
        $kelasCount = 10; // Jumlah kelas yang ada
        $currentKelas = 1; // Nomor kelas yang sedang digunakan
        
        // Generate fake data for users and siswas tables
        for ($i = 1; $i <= 100; $i++) {
            $name = $faker->name;
            
            // Generate fake data for users table
            $userData = [
                'name' => $name,
                'nisn_nip' => $faker->unique()->numberBetween(1000, 9999),
                'level' => $faker->randomElement(['siswa']),
                'password' => Hash::make('123')
            ];
            
            // Insert user data into the users table
            $userId = DB::table('users')->insertGetId($userData);
            
            // Generate fake data for siswas table
            $siswaData = [
                'namasiswa' => $name,
                'foto' => 'foto.png',
                'tempatlahir' => $faker->city,
                'tanggallahir' => $faker->date(),
                'jeniskelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'kelas_id' => $currentKelas, // Assign current kelas_id
                'user_id' => $userId
            ];
            
            // Insert siswa data into the siswas table
            DB::table('siswas')->insert($siswaData);
            
            // Increment currentKelas and reset to 1 if it exceeds the total kelasCount
            $currentKelas++;
            if ($currentKelas > $kelasCount) {
                $currentKelas = 1;
            }
        }
    }



    public function RunFakeData(){
        // Panggil fungsi GuruFakeData
        $this->GuruFakeData();
        $this->WalasFakeData();
        $this->KelasFakeData();
        $this->SiswaFakeData();
        
        
        // Tampilkan pesan sukses atau alihkan ke halaman lain
        return "Data palsu berhasil dibuat.";
    }
}
