<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SuratPengantar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengajuan';
    protected $table = 'surat_pengantars';

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
        'foto_ktp',
        'file_pdf',
        'id_rt',
        'id_rw',
        'file_ttd_rt',
        'file_ttd_rw',
        'kode_verifikasi',
    ];
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'id_pengantar', 'id_user');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_pengantar', 'id_warga');
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt');
    }

    public function rw()
    {
        return $this->belongsTo(RW::class, 'id_rw');
    }
}
