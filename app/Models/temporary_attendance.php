<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporary_attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time_in',
        'date_time_out',
        'is_attend',
        'checkpoint_id',
        'attendance_timetable_id',
        'student_study_session_id',
        'platform',
    ];
}
