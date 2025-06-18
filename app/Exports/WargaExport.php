<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WargaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Warga::select([
            'NIK',
            'NKK',
            'name',
            'jenis_kelamin',
            'kewarganegaraan',
            'agama',
            'pekerjaan',
            'alamat',
            'tempat_lahir',
            'tanggal_lahir',
            'golongan_darah',
            'status_perkawinan',
            'pendidikan',
            'status_keluarga',
            'status_penduduk',
            'tanggal_meninggal',
            'id_RT',
            'id_RW'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'NKK',
            'Nama',
            'jenis kelamin',
            'Kewarganegaraan',
            'Agama',
            'Pekerjaan',
            'Alamat',
            'Tempat lahir',
            'Tanggal lahir',
            'Golongan darah',
            'Status perkawinan',
            'Pendidikan',
            'Status hubungan dalam Keluarga',
            'Status penduduk',
            'Tanggal meninggal',
            'RT',
            'RW',
        ];
    }
}
