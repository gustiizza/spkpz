<?php

namespace Database\Seeders;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\SubKriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Kriteria
        $kriteria = [
            ['kode_kriteria' => 'K1', 'nama' => 'Jumlah Penghasilan', 'atribut' => 'cost',],
            ['kode_kriteria' => 'K2', 'nama' => 'Jumlah Tanggungan', 'atribut' => 'benefit',],
            ['kode_kriteria' => 'K3', 'nama' => 'Status Pernikahan', 'atribut' => 'benefit',],
            ['kode_kriteria' => 'K4', 'nama' => 'Status Pendidikan Terakhir', 'atribut' => 'cost',],
            ['kode_kriteria' => 'K5', 'nama' => 'Status Pekerjaan', 'atribut' => 'cost',],
        ];
        foreach ($kriteria as $data) {
            Kriteria::create([
                'kode_kriteria' => $data['kode_kriteria'],
                'nama' => $data['nama'],
                'atribut' => $data['atribut'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //Sub Kriteria
        $subkriteria = [
            ['kriteria_id' => 1, 'nama_sub_kriteria' => '>1.000.000', 'nilai_sk' => 5],
            ['kriteria_id' => 1, 'nama_sub_kriteria' => '>1.00.000 – 2.000.000', 'nilai_sk' => 3],
            ['kriteria_id' => 1, 'nama_sub_kriteria' => '>2.000.00', 'nilai_sk' => 1],

            ['kriteria_id' => 2, 'nama_sub_kriteria' => '>= 3 Anak', 'nilai_sk' => 5],
            ['kriteria_id' => 2, 'nama_sub_kriteria' => '2 Anak', 'nilai_sk' => 3],
            ['kriteria_id' => 2, 'nama_sub_kriteria' => '<=1 Anak', 'nilai_sk' => 1],

            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Janda/Duda', 'nilai_sk' => 5],
            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Menikah', 'nilai_sk' => 3],
            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Belum Menikah', 'nilai_sk' => 1],

            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Tidak Sekolah', 'nilai_sk' => 5],
            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Sekolah', 'nilai_sk' => 3],
            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Perguruan Tinggi', 'nilai_sk' => 1],

            ['kriteria_id' => 5, 'nama_sub_kriteria' => 'Tidak Bekerja', 'nilai_sk' => 5],
            ['kriteria_id' => 5, 'nama_sub_kriteria' => 'Pekerja tidak tetap', 'nilai_sk' => 3],
            ['kriteria_id' => 5, 'nama_sub_kriteria' => 'Pekerja Tetap', 'nilai_sk' => 1],
        ];
        foreach ($subkriteria as $data) {
            SubKriteria::create([
                'kriteria_id' => $data['kriteria_id'],
                'nama_sub_kriteria' => $data['nama_sub_kriteria'],
                'nilai_sk' => $data['nilai_sk'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //Bobot
        $bobot = [
            ['kriteria_id' => 1, 'nilai_bk' => 20],
            ['kriteria_id' => 2, 'nilai_bk' => 20],
            ['kriteria_id' => 3, 'nilai_bk' => 20],
            ['kriteria_id' => 4, 'nilai_bk' => 10],
            ['kriteria_id' => 5, 'nilai_bk' => 30],
        ];
        foreach ($bobot as $data) {
            Bobot::create([
                'kriteria_id' => $data['kriteria_id'],
                'nilai_bk' => $data['nilai_bk'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
