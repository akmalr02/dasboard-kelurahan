<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RtSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rts')->delete();

        $totalRW = 8;

        for ($rwId = 1; $rwId <= $totalRW; $rwId++) {
            $jumlahRT = rand(7, 8);

            for ($rt = 1; $rt <= $jumlahRT; $rt++) {
                DB::table('rts')->insert([
                    'no_RT' => str_pad($rt, 2, '0', STR_PAD_LEFT),
                    'id_RW' => $rwId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
