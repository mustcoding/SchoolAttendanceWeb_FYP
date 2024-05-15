<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time_in',
        'date_time_out',
        'is_attend',
        'checkpoint_id',
        'attendance_timetable_id',
        'student_study_session_id',
    ];

    public function studentStudySession()
    {
        return $this->belongsTo(StudentStudySession::class);
    }

    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class, 'checkpoint_id');
    }

    public function attendanceTimetable()
    {
        return $this->belongsTo(AttendanceTimetable::class, 'attendance_timetable_id');
    }

}
