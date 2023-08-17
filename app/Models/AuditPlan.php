<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AuditPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'study_program_id',
        'lead_auditor_id',
        'auditor_1_id',
        'auditor_2_id',
        'status',
        'tanggal_rtm',
        'kesimpulan',
        'foto_kegiatan',
        'tahun'
    ];

    protected $appends = [
        'foto'
    ];

    public function getFotoAttribute()
    {
        return url('storage/' . $this->foto_kegiatan);
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function study_program(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lead_auditor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auditor_1(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auditor_2(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function audits(): HasMany
    {
        return $this->hasMany(Audit::class);
    }

    public function rekomendasi(): HasOne
    {
        return $this->hasOne(Rekomendasi::class);
    }


    public function bukti(): HasOne
    {
        return $this->hasOne(Bukti::class);
    }
}
