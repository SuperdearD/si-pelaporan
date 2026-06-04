<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IncidentDevelopment extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_id',
        'bentuk_pengembangan',
        'hasil_pengembangan',
        'persentase',
        'status',
        'tanggal',
        'user_id'
    ];

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function progresses(): HasMany
    {
        return $this->hasMany(DevelopmentProgress::class);
    }

    public function report(): HasOne
    {
        return $this->hasOne(DevelopmentReport::class);
    }
}
