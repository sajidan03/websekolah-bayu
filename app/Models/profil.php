<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class profil extends Model
{
    protected $fillable = [
        'nama_menu',
        'judul',
        'jabatan',
        'nama',
        'nama_kepala_sekolah',
        'konten',
        'isi_visi',
        'isi_misi',
        'tahun_berdiri',
        'jumlah_siswa',
        'lulusan_sukes',
        'description',
        'gambar',
        'urutan',
        'status',
    ];

    /**
     * Get the history images for this profile (specifically for sejarah).
     */
    public function historyImages(): HasMany
    {
        return $this->hasMany(HistoryImage::class);
    }
}
