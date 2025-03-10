<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccurrenceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_Delete',
      
    ];

    public function attendanceTimetables()
    {
        return $this->hasMany(AttendanceTimetable::class, 'occurrence_id');
    }
}
