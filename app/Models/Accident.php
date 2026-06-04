<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accident extends Model
{
    use HasFactory;

    public $timestamps = false; // Karena di migration tidak ada timestamps()
    protected $fillable = [
        'incident_id',
        'accident_place',
        'accident_condition',
        'accident_description',
        'safety_incidents'
    ];

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }
}
