<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }
}
