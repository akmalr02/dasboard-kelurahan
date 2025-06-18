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
}
