<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SuratPengantar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengajuan';
    protected $table = 'surat_Pengantars';

    protected $fillable = [
        'id_pengantar',
        'nama',
        'NIK',
        'NKK',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'alamat',
        'keperluan',
        'email',
        'status',
        'tanggal_pengajuan',
        'id_rt',
        'id_rw',
        'file_ttd_rt',
        'file_ttd_rw',
        'kode_verifikasi',
    ];
}
