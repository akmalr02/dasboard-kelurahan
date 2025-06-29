<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WargaExport implements FromCollection, WithHeadings
{
    public function collection()
    {

        // dd(Warga::with(['rw', 'rt'])->first());
        return Warga::with(['rt.rw'])
            ->orderBy('id_RW')
            ->orderBy('id_RT')
            ->orderBy('NKK')
            ->orderBy('NIK')
            ->orderBy('name')
            ->get()
            ->map(function ($warga) {
                return [
                    $warga->NIK,
                    $warga->NKK,
                    $warga->name,
                    $warga->jenis_kelamin,
                    $warga->kewarganegaraan,
                    $warga->agama,
                    $warga->pekerjaan,
                    $warga->alamat,
                    $warga->tempat_lahir,
                    $warga->tanggal_lahir,
                    $warga->golongan_darah,
                    $warga->status_perkawinan,
                    $warga->pendidikan,
                    $warga->status_keluarga,
                    $warga->status_penduduk,
                    $warga->tanggal_meninggal,
                    optional($warga->rt)->no_RT ?? 'N/A',
                    optional($warga->rt->rw)->no_RW ?? 'N/A',
                ];
            });
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
