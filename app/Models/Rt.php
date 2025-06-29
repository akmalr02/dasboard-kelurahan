<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $primaryKey = 'id_RT';

    protected $fillable = [
        'name_RT',
        'no_RT',
        'id_RW',
        'id_user',
    ];

    protected $guarded = ['id_RT'];


    // Relasi ke RW
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_RW', 'id_RW');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke warga
    public function wargas()
    {
        return $this->hasMany(Warga::class, 'id_RT', 'id_RT');
    }
}
