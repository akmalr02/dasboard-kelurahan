<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RwSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 8; $i++) {
            DB::table('rws')->insert([
                'id_user' => null,
                'no_RW' => str_pad($i, 2, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
