<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Warga extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_warga';
    protected $table = 'wargas';

    protected $guarded = ['id_warga'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function warga()
    {
        return $this->hasOne(Warga::class, 'id_user', 'id_user');
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'id_RT', 'id_RT');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_RW', 'id_RW');
    }
}
