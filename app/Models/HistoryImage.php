<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryImage extends Model
{
    protected $fillable = [
        'profil_id',
        'image_path',
    ];

    /**
     * Get the profil that owns the history image.
     */
    public function profil(): BelongsTo
    {
        return $this->belongsTo(profil::class);
    }
}

