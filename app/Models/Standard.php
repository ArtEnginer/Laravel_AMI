<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Standard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'value',
    ];

    public function pertanyaan(): HasMany
    {
        return $this->hasMany(Question::class, 'standard_id', 'id');
    }
    
    public function bukti(): HasMany
    {
        return $this->hasMany(Bukti::class, 'standard_id', 'id');
    }

    public function score(): HasMany
    {
        return $this->hasMany(Value::class, 'standard_id', 'id');
    }

    public function rekomendasi(): HasMany
    {
        return $this->hasMany(Rekomendasi::class, 'standard_id', 'id');
    }
}
