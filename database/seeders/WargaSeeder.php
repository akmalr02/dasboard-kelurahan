<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $totalNKK = 200;
        $maxPerNKK = 5;
        $batchSize = 300;

        $rtIds = DB::table('rts')->pluck('id_RT')->toArray();
        $rwIds = DB::table('rws')->pluck('id_RW')->toArray();

        $nkkList = [];
        for ($i = 0; $i < $totalNKK; $i++) {
            $nkkList[] = fake()->numerify('1###############');
        }

        $wargaBatch = [];
        foreach ($nkkList as $index => $nkk) {
            $anggotaKeluarga = rand(1, $maxPerNKK);

            $id_RT = fake()->randomElement($rtIds);
            $id_RW = fake()->randomElement($rwIds);

            for ($j = 0; $j < $anggotaKeluarga; $j++) {
                $isKepalaKeluarga = $j === 0;
                $jenisKelamin = fake()->randomElement(['L', 'P']);
                $statusPenduduk = fake()->randomElement(['hidup', 'pindah', 'meninggal']);

                $wargaBatch[] = [
                    'NIK' => fake()->unique()->numerify('1###############'),
                    'NKK' => $nkk,
                    'name' => fake()->name(),
                    'jenis_kelamin' => $jenisKelamin,
                    'kewarganegaraan' => fake()->randomElement(['WNI', 'WNA']),
                    'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']),
                    'pekerjaan' => fake()->jobTitle(),
                    'alamat' => fake()->address(),
                    'tempat_lahir' => fake()->city(),
                    'tanggal_lahir' => fake()->date('Y-m-d'),
                    'golongan_darah' => fake()->randomElement(['A', 'B', 'AB', 'O', 'tidak tahu']),
                    'status_perkawinan' => fake()->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
                    'pendidikan' => fake()->randomElement(['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3']),
                    'status_keluarga' => $isKepalaKeluarga ? 'kepala_keluarga' : ($jenisKelamin == 'P' && $j == 1 ? 'istri' : ($j > 1 ? 'anak' : 'lainnya')),
                    'status_penduduk' => $statusPenduduk,
                    'tanggal_meninggal' => $statusPenduduk === 'meninggal' ? fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d') : null,
                    'id_RT' => $id_RT,
                    'id_RW' => $id_RW,
                    'role' => 'warga',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (count($wargaBatch) >= $batchSize) {
                    DB::table('wargas')->insert($wargaBatch);
                    $wargaBatch = [];
                }
            }
        }

        if (!empty($wargaBatch)) {
            DB::table('wargas')->insert($wargaBatch);
        }
    }
}
