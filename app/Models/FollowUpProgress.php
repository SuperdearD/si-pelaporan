<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUpProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_follow_up_id',
        'message_id',
        'pic',
        'keterangan',
        'persentase_progress',
        'file'
    ];

    public function followUp(): BelongsTo
    {
        return $this->belongsTo(IncidentFollowUp::class, 'incident_follow_up_id', 'id');
    }
}
