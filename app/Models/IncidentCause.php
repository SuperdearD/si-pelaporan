<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentCause extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'incident_id',
        'unsafe_action',
        'unsafe_condition',
        'person_factor',
        'job_factor',
        'env_factor'
    ];

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }
}
