<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKelahiran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelahiran';
    protected $table = 'surat_kelahirans';

    protected $fillable = [
        'nama_anak',
        'anak_ke',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'hari_lahir',
        'id_ibu',
        'id_ayah',
        'id_admin',
        'file_ttd_admin',
        'kode_verifikasi',
    ];

    public function ibu()
    {
        return $this->belongsTo(Warga::class, 'id_ibu', 'id_warga');
    }

    public function ayah()
    {
        return $this->belongsTo(Warga::class, 'id_ayah', 'id_warga');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}
