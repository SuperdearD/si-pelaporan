<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncidentFollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_id',
        'corrective_action',
        'target_pengendalian',
        'bentuk_pengendalian',
        'penanggung_jawab',
        'status',
        'progress'
    ];

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }

    public function followUpProgresses(): HasMany
    {
        return $this->hasMany(FollowUpProgress::class, 'incident_follow_up_id');
    }
}
