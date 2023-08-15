<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bukti extends Model
{
    use HasFactory;

    protected $fillable = [
        'audit_plan_id',
        'standard_id',
        'user_id',
        'value',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(AuditPlan::class);
    }

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}