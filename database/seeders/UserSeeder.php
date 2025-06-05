<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_user' => 1,
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Gunakan password yang kuat di produksi
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userId = 106; // 8 RW + 96 RT sudah dipakai (1-104)

        // Ambil satu warga per NKK (kepala keluarga)
        $kepalaKeluargas = DB::table('wargas')
            ->where('status_keluarga', 'kepala_keluarga')
            ->select('id_warga', 'name', 'NKK', 'id_RT', 'id_RW')
            ->get();

        // Buat user batch untuk efisiensi
        $userBatch = [];
        $wargaUpdates = [];

        foreach ($kepalaKeluargas as $warga) {
            $userBatch[] = [
                'id_user' => $userId,
                'name' => $warga->name,
                'email' => $warga->name . $userId . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $wargaUpdates[] = [
                'id_warga' => $warga->id_warga,
                'id_user' => $userId
            ];

            $userId++;

            // Insert batch 100 user sekaligus
            if (count($userBatch) >= 100) {
                DB::table('users')->insert($userBatch);
                $userBatch = [];
            }
        }

        // Insert sisa user yang belum di-insert
        if (!empty($userBatch)) {
            DB::table('users')->insert($userBatch);
        }

        // Update id_user untuk setiap warga kepala keluarga
        foreach ($wargaUpdates as $update) {
            DB::table('wargas')
                ->where('id_warga', $update['id_warga'])
                ->update(['id_user' => $update['id_user']]);
        }
    }
}
