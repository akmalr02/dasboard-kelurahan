<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';
    protected $primaryKey = 'id_RW';

    protected $fillable = [
        'name_RW',
        'no_RW',
        'id_user',
    ];

    protected $guarded = ['id_RW'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function rts()
    {
        return $this->hasMany(Rt::class, 'id_RW', 'id_RW');
    }

    public function wargas()
    {
        return $this->hasMany(Warga::class, 'id_RW', 'id_RW');
    }
}
