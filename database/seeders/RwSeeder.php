<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rwCount = 8;
        $userId = 2;

        for ($i = 1; $i <= $rwCount; $i++) {
            DB::table('users')->insert([
                'id_user' => $userId,
                'name' => 'Ketua RW ' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'email' => 'rw' . str_pad($i, 2, '0', STR_PAD_LEFT) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengelola_rw',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('rws')->insert([
                'id_RW' => $i,
                'name_RW' => 'RW ' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'no_RW' => $i,
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $userId++;
        }
    }
}
