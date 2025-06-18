<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredWargaExport implements FromCollection, WithHeadings
{
    protected $tipe;
    protected $nilai;

    public function __construct($tipe, $nilai)
    {
        $this->tipe = $tipe;   // contoh: 'rt' atau 'rw'
        $this->nilai = $nilai; // contoh: '01'
    }

    public function headings(): array
    {
        return [
            'NIK',
            'NKK',
            'Nama',
            'Jenis Kelamin',
            'Kewarganegaraan',
            'Agama',
            'Pekerjaan',
            'Alamat',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Golongan Darah',
            'Status Perkawinan',
            'Pendidikan',
            'Status Hubungan Keluarga',
            'Status Kehidupan',
            'Tanggal Meninggal',
            'RT',
            'RW',
        ];
    }

    public function collection()
    {
        return Warga::select(
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
        )
            ->when($this->tipe === 'rw', fn($q) => $q->where('id_RW', $this->nilai))
            ->when($this->tipe === 'rt', fn($q) => $q->where('id_RT', $this->nilai))
            ->get();
    }
}
