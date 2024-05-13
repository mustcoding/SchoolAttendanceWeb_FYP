<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTimetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'occurrence_id',
        'is_Delete',
    ];

    public function occurrence()
    {
        return $this->belongsTo(OccurrenceType::class, 'occurrence_id');
    }
}
