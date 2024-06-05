<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSessionClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_session_id',
        'class_id',
        'staff_id',
        'is_Delete',
    ];

    public function attendanceTimetable()
    {
        return $this->belongsTo(AttendanceTimetable::class);
    }

    public function schoolSession()
    {
        return $this->belongsTo(SchoolSession::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    
}
