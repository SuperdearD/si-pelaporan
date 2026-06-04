<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'department',
        'position',
        'age',
        'work_experience',
        'responsibility',
        'is_approved',
        'approved_by',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'incident_user');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function accident(): HasOne
    {
        return $this->hasOne(Accident::class);
    }

    public function cause(): HasOne
    {
        return $this->hasOne(IncidentCause::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(IncidentFollowUp::class);
    }

    public function developments(): HasMany
    {
        return $this->hasMany(IncidentDevelopment::class);
    }
}
