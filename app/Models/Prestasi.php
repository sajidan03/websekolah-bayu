<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = [
        'nama_prestasi',
        'isi',
        'foto',
        'kategori',
        'status',
    ];
}
