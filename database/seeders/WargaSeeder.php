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

        $rwCount = 8;
        $rtPerRw = 6;

        $wargaId = 1;
        $wargaBatch = [];

        $nkkList = [];
        for ($i = 0; $i < $totalNKK; $i++) {
            $nkkList[] = fake()->numerify('1###############');
        }

        foreach ($nkkList as $index => $nkk) {
            $anggotaKeluarga = rand(1, $maxPerNKK);

            // Hitung RT dan RW berdasarkan indeks NKK
            $rw = ($index % $rwCount) + 1;
            $rt = ($index % ($rwCount * $rtPerRw)) % $rtPerRw + 1;

            for ($j = 0; $j < $anggotaKeluarga; $j++) {
                $isKepalaKeluarga = $j === 0;
                $jenisKelamin = fake()->randomElement(['L', 'P']);
                $statusPenduduk = fake()->randomElement(['hidup', 'pindah', 'meninggal']);

                $wargaBatch[] = [
                    'id_warga' => $wargaId++,
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
                    'tanggal_meninggal' => $statusPenduduk === 'meninggal'
                        ? fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d')
                        : null,
                    'id_RT' => $rt,
                    'id_RW' => $rw,
                    'role' => 'warga',
                    'id_user' => null,
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
