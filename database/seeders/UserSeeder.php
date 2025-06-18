<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        DB::table('users')->insert([
            'id_user' => 1,
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ambil semua warga yang berstatus kepala keluarga
        // $kepalaKeluargas = DB::table('wargas')
        //     ->where('status_keluarga', 'kepala_keluarga')
        //     ->select('id_warga', 'name')
        //     ->get();

        // $userId = 2; // Mulai setelah admin (id_user = 1)
        // $userBatch = [];
        // $wargaUpdates = [];

        // foreach ($kepalaKeluargas as $warga) {
        //     $userBatch[] = [
        //         'id_user' => $userId,
        //         'name' => $warga->name,
        //         'email' => 'warga' . $userId . '@example.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'warga',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];

        //     $wargaUpdates[] = [
        //         'id_warga' => $warga->id_warga,
        //         'id_user' => $userId,
        //     ];

        //     $userId++;

        //     if (count($userBatch) >= 100) {
        //         DB::table('users')->insert($userBatch);
        //         $userBatch = [];
        //     }
        // }

        // if (!empty($userBatch)) {
        //     DB::table('users')->insert($userBatch);
        // }

        // foreach ($wargaUpdates as $update) {
        //     DB::table('wargas')
        //         ->where('id_warga', $update['id_warga'])
        //         ->update(['id_user' => $update['id_user']]);
        // }
    }
}
