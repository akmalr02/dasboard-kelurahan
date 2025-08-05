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

        echo "Loading file Excel...\n";
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        unset($rows[1]);

        $data = [];
        $skipped = 0;
        $processed = 0;

        echo "Processing " . count($rows) . " rows...\n";

        foreach ($rows as $rowIndex => $row) {
            if (empty($row['A'])) {
                $skipped++;
                continue;
            }

            $id_rt = $row['O'] ?? null;
            $id_rw = $row['P'] ?? null;

            if (!$id_rt || !$id_rw) {
                echo "Row {$rowIndex}: ID RT/RW kosong - RT: {$id_rt}, RW: {$id_rw}\n";
                $skipped++;
                continue;
            }

            $rt_exists = DB::table('rts')->where('id_RT', $id_rt)->exists();
            $rw_exists = DB::table('rws')->where('id_RW', $id_rw)->exists();

            if (!$rt_exists) {
                echo "Row {$rowIndex}: ID RT tidak ditemukan: {$id_rt}\n";
                $skipped++;
                continue;
            }

            if (!$rw_exists) {
                echo "Row {$rowIndex}: ID RW tidak ditemukan: {$id_rw}\n";
                $skipped++;
                continue;
            }

            $existing = DB::table('wargas')->where('NIK', $row['A'])->exists();
            if ($existing) {
                echo "Row {$rowIndex}: NIK sudah ada: {$row['A']}\n";
                $skipped++;
                continue;
            }

            $tanggalLahir = null;
            if (!empty($row['J'])) {
                if (is_numeric($row['J'])) {
                    $tanggalLahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['J'])->format('Y-m-d');
                } else {
                    $tanggalLahir = date('Y-m-d', strtotime($row['J']));
                }
            }

            $data[] = [
                'NIK' => $row['A'],
                'NKK' => $row['B'] ?? null,
                'name' => $row['C'] ?? null,
                'jenis_kelamin' => $row['D'] ?? null,
                'kewarganegaraan' => $row['E'] ?? null,
                'agama' => $row['F'] ?? null,
                'pekerjaan' => $row['G'] ?? null,
                'alamat' => $row['H'] ?? null,
                'tempat_lahir' => $row['I'] ?? null,
                'tanggal_lahir' => $tanggalLahir,
                'golongan_darah' => $row['K'] ?? null,
                'status_perkawinan' => $row['L'] ?? null,
                'pendidikan' => $row['M'] ?? null,
                'status_keluarga' => $row['N'] ?? null,
                'status_penduduk' => 'hidup',
                'tanggal_meninggal' => null,
                'id_RT' => $id_rt,
                'id_RW' => $id_rw,
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $processed++;

            if ($processed % 100 == 0) {
                echo "Processed: {$processed} rows\n";
            }
        }

        echo "Total processed: {$processed}, Skipped: {$skipped}\n";

        if (empty($data)) {
            echo "Tidak ada data yang valid untuk dimasukkan\n";
            return;
        }

        echo "Inserting " . count($data) . " records to database...\n";

        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunkIndex => $chunk) {
            DB::table('wargas')->insert($chunk);
            echo "Inserted chunk " . ($chunkIndex + 1) . "/" . count($chunks) . "\n";
        }

        echo "Seeding completed!\n";
    }
}
