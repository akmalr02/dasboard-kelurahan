<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Warga extends Model
{
    use HasFactory;

    protected $table = 'wargas';

    protected $guarded = ['id_warga'];
}
