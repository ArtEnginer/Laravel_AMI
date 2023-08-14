<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'audit_plan_id',
        'question_id',
        'value_id',
    ];

    public function audit_plan(): BelongsTo
    {
        return $this->belongsTo(AuditPlan::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function value(): BelongsTo
    {
        return $this->belongsTo(Value::class);
    }
}
