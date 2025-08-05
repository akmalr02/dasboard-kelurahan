<?php

namespace App\Exports;

use App\Models\Warga;
use App\Models\Rt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredWargaExport implements FromCollection, WithHeadings
{
    protected $tipe;
    protected $nilai;

    public function __construct($tipe, $nilai)
    {
        $this->tipe = $tipe;
        $this->nilai = $nilai;
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
        $query = Warga::with(['rt.rw']);

        // ✅ Tambahkan filter berdasarkan tipe
        switch ($this->tipe) {
            case 'rw':
                $rtIDs = RT::where('id_RW', $this->nilai)->pluck('id_RT');
                $query->whereIn('id_RT', $rtIDs);
                break;

            case 'rt':
                // nilai berupa no_RT, cari id_RT
                $rt = RT::where('no_RT', $this->nilai)->first();
                if ($rt) {
                    $query->where('id_RT', $rt->id_RT);
                }
                break;

            case 'rt_with_id':
                $query->where('id_RT', $this->nilai);
                break;
        }

        return $query->orderBy('id_RT')
            ->orderBy('NKK')
            ->orderBy('NIK')
            ->orderBy('name')
            ->get()
            // ->filter(fn($w) => $w->rt && $w->rw)
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
}
