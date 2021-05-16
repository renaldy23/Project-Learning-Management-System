<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                "nama_jurusan" => "Teknik Pendingin dan Tata Udara",
                "singkatan" => "TPTU",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "nama_jurusan" => "Teknik Otomasi Industri",
                "singkatan" => "TOI",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "nama_jurusan" => "Instrumentasi Otomatisasi Proses",
                "singkatan" => "IOP",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "nama_jurusan" => "Teknik Elektronika Daya dan Komunikasi",
                "singkatan" => "TEDK",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nama_jurusan" => "Teknik Elektronika Industri",
                "singkatan" => "TEI",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nama_jurusan" => "Sistem Informasi Jaringan dan Aplikasi",
                "singkatan" => "SIJA",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nama_jurusan" => "Rekayasa Perangkat Lunak",
                "singkatan" => "RPL",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nama_jurusan" => "Produksi Film dan Program Televisi",
                "singkatan" => "PFPT",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nama_jurusan" => "Teknik Mekatronika",
                "singkatan" => "MEKA",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        foreach ($datas as $data) {
            DB::table('jurusan')->insert($data);
        }
    }
}
