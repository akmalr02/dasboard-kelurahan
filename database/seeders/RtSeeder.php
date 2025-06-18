<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RtSeeder extends Seeder
{
    public function run(): void
    {
        $rwCount = 8;
        $rtPerRw = 4;

        $id = 1;
        for ($rw = 1; $rw <= $rwCount; $rw++) {
            for ($rt = 1; $rt <= $rtPerRw; $rt++) {
                DB::table('rts')->insert([
                    'id_user' => null,
                    'no_RT' => str_pad($rt, 2, '0', STR_PAD_LEFT),
                    'id_RW' => $rw,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
