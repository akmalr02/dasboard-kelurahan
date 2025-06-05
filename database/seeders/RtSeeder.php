<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rtPerRw = 12; // 12 RT per RW
        $rwCount = 8;  // Total 8 RW
        $rtCount = $rtPerRw * $rwCount; // Total 96 RT
        $userId = 10;   // Mulai dari 9 karena 8 id_user pertama untuk RW (1-8)
        $rtId = 1;     // ID untuk primary key di tabel RT

        for ($rwId = 1; $rwId <= $rwCount; $rwId++) {
            for ($rtNum = 1; $rtNum <= $rtPerRw; $rtNum++) {
                $rtDisplayNum = str_pad($rtNum, 2, '0', STR_PAD_LEFT);

                DB::table('users')->insert([
                    'id_user' => $userId,
                    'name' => 'Ketua RT ' . $rtDisplayNum . ' RW ' . str_pad($rwId, 2, '0', STR_PAD_LEFT),
                    'email' => 'rt' . $rtDisplayNum . 'rw' . str_pad($rwId, 2, '0', STR_PAD_LEFT) . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'pengelola_rt',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('rts')->insert([
                    'id_RT' => $rtId++,
                    'name_RT' => 'RT ' . $rtDisplayNum,
                    'no_RT' => $rtNum,
                    'id_RW' => $rwId,
                    'id_user' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $userId++;
            }
        }
    }
}
