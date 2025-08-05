<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FakeWargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $totalNKK = 200;
        $maxPerNKK = 5;
        $batchSize = 300;

        $rtData = DB::table('rts')
            ->join('rws', 'rts.id_RW', '=', 'rws.id_RW')
            ->select('rts.id_RT', 'rws.id_RW')
            ->get();

        $nkkList = [];
        for ($i = 0; $i < $totalNKK; $i++) {
            $nkkList[] = $faker->numerify('1###############');
        }

        $wargaBatch = [];

        foreach ($nkkList as $nkk) {
            $anggotaKeluarga = rand(1, $maxPerNKK);

            $selected = $rtData->random();
            $id_RT = $selected->id_RT;
            $id_RW = $selected->id_RW;

            for ($j = 0; $j < $anggotaKeluarga; $j++) {
                $isKepalaKeluarga = $j === 0;
                $jenisKelamin = $faker->randomElement(['L', 'P']);
                $statusPenduduk = $faker->randomElement(['hidup', 'pindah', 'meninggal']);

                $wargaBatch[] = [
                    'NIK' => $faker->unique()->numerify('1###############'),
                    'NKK' => $nkk,
                    'name' => $faker->name($jenisKelamin === 'L' ? 'male' : 'female'),
                    'jenis_kelamin' => $jenisKelamin,
                    'kewarganegaraan' => $faker->randomElement(['WNI', 'WNA']),
                    'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']),
                    'pekerjaan' => $faker->jobTitle(),
                    'alamat' => $faker->address(),
                    'tempat_lahir' => $faker->city(),
                    'tanggal_lahir' => $faker->date('Y-m-d'),
                    'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O', 'tidak tahu']),
                    'status_perkawinan' => $faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
                    'pendidikan' => $faker->randomElement(['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3']),
                    'status_keluarga' => $isKepalaKeluarga
                        ? 'kepala_keluarga'
                        : ($jenisKelamin === 'P' && $j === 1 ? 'istri' : ($j > 1 ? 'anak' : 'lainnya')),
                    'status_penduduk' => $statusPenduduk,
                    'tanggal_meninggal' => $statusPenduduk === 'meninggal' ? $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d') : null,
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
