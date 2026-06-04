<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevelopmentProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_development_id',
        'message_id',
        'pic',
        'tanggal',
        'hasil_progress',
        'persentase',
        'file'
    ];

    public function development(): BelongsTo
    {
        return $this->belongsTo(IncidentDevelopment::class, 'incident_development_id', 'id');
    }
}
