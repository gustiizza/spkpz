<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Penerima;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Create 9 kecamatan records
        $kecamatanNames = [
            'Anjongan',
            'Jongkat',
            'Mempawah Hilir',
            'Mempawah Timur',
            'Sadaniang',
            'Segedong',
            'Sungai Kunyit',
            'Sungai Pinyuh',
            'Toho',
        ];

        foreach ($kecamatanNames as $name) {
            Kecamatan::create([
                'nama' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Create "Operator" user
        User::create([
            'nama' => 'Operator',
            'email' => 'operator@example.com',
            'status' => 'op',
            'password' => bcrypt('123123123'),
            'kecamatan_id' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create "Decision Maker" user
        User::create([
            'nama' => 'Decision Maker',
            'email' => 'decisionmaker@example.com',
            'status' => 'dm',
            'password' => bcrypt('123123123'),
            'kecamatan_id' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create "demo" user
        User::create([
            'nama' => 'demo',
            'email' => 'demorelawan@example.com',
            'status' => 'rz',
            'password' => bcrypt('123123123'),
            'kecamatan_id' => 1, // Assign an existing kecamatan_id
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create 2 users per kecamatan
        $kecamatans = Kecamatan::all();
        foreach ($kecamatans as $kecamatan) {
            for ($i = 0; $i < 2; $i++) {
                $faker = Faker::create('id_ID');
                User::create([
                    'nama' => $faker->firstName,
                    'email' => $faker->email,
                    'status' => 'rz',
                    'password' => bcrypt('123123123'),
                    'kecamatan_id' => $kecamatan->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // Create 5 penerima per kecamatan
        foreach ($kecamatans as $kecamatan) {
            for ($i = 0; $i < 5; $i++) {
                $a = $faker->streetAddress;
                $b = $faker->streetName;
                $c = $faker->address;
                $fulladdress = $a . ', ' . $b;
                $faker = Faker::create('id_ID');
                Penerima::create([
                    'nama' => $faker->name,
                    'alamat' => $fulladdress,
                    'kecamatan' => $kecamatan->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
