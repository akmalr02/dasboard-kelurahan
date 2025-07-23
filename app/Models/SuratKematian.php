<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKematian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kematian';
    protected $table = 'surat_kematians';

    protected $fillable = [
        'id_pelapor',
        'id_admin',
        'nama_warga',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'hari_meninggal',
        'tanggal_meninggal',
        'jam_meninggal',
        'penyebab',
        'tempat_pemakaman',
        'file_ttd_admin',
        'kode_verifikasi',
    ];

    public function pelapor()
    {
        return $this->belongsTo(Warga::class, 'id_pelapor', 'id_warga');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}
