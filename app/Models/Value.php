<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'standard_id',
        'answer',
        'score',
    ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }
}
