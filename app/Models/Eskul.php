<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    protected $fillable = [
        'nama_eskul',
        'pembina',
        'deskripsi',
        'gambar',
        'status',
    ];
}
