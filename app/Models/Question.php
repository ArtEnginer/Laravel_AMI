<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'standard_id',
        'questionText',
    ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }
}
