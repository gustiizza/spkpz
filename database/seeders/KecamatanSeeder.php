<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan migrate:fresh --seed --seeder=KecamatanSeeder
     */
    public function run()
    {
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
            DB::table('kecamatan')->insert([
                'nama' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
