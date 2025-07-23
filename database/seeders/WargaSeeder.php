<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/public/data warga.xlsx');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        // Buang header
        unset($rows[1]);

        $data = [];
        foreach ($rows as $row) {
            $rt = DB::table('rts')->where('no_RT', $row['O'])->first();
            $rw = DB::table('rws')->where('no_RW', $row['P'])->first();

            if (!$rt || !$rw) {
                continue; // lewati jika tidak ada RT/RW
            }

            $data[] = [
                'NIK' => $row['A'],
                'NKK' => $row['B'],
                'name' => $row['C'],
                'jenis_kelamin' => $row['D'],
                'kewarganegaraan' => $row['E'],
                'agama' => $row['F'],
                'pekerjaan' => $row['G'],
                'alamat' => $row['H'],
                'tempat_lahir' => $row['I'],
                'tanggal_lahir' => date('Y-m-d', strtotime($row['J'])),
                'golongan_darah' => $row['K'],
                'status_perkawinan' => $row['L'],
                'pendidikan' => $row['M'],
                'status_keluarga' => $row['N'],
                'status_penduduk' => 'hidup',
                'tanggal_meninggal' => null,
                'id_RT' => $rt->id_RT,
                'id_RW' => $rw->id_RW,
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Masukkan batch
        $chunks = array_chunk($data, 300);
        foreach ($chunks as $chunk) {
            DB::table('wargas')->insert($chunk);
        }
    }
}
