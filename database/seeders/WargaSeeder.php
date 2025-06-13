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
        $rtPerRw = 12;
        $rwCount = 8;
        $batchSize = 300;

        $wargaId = 1;
        $wargaBatch = [];

        $nkkList = [];
        for ($i = 0; $i < $totalNKK; $i++) {
            $nkkList[] = fake()->numerify('1###############');
        }

        foreach ($nkkList as $nkkIndex => $nkk) {
            $rwId = (floor($nkkIndex / ($totalNKK / $rwCount)) % $rwCount) + 1;
            $rtNum = (floor($nkkIndex / ($totalNKK / ($rwCount * $rtPerRw))) % $rtPerRw) + 1;

            $rtData = DB::table('rts')
                ->where('no_RT', $rtNum)
                ->where('id_RW', $rwId)
                ->first();

            if (!$rtData) continue;

            $rtId = $rtData->id_RT;
            $anggotaKeluarga = rand(1, $maxPerNKK);

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
                    'id_RT' => $rtId,
                    'id_RW' => $rwId,
                    'jabatan' => 'warga',
                    'id_user' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Insert batch jika sudah mencapai batas batch
                if (count($wargaBatch) >= $batchSize) {
                    DB::table('wargas')->insert($wargaBatch);
                    $wargaBatch = []; // Reset batch
                }
            }
        }

        // Insert sisa data jika masih ada
        if (!empty($wargaBatch)) {
            DB::table('wargas')->insert($wargaBatch);
        }
    }
}
