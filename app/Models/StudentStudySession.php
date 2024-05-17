<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStudySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'ssc_id',
        'is_Delete',
    ];

    public function schoolSessionClass()
    {
        return $this->belongsTo(SchoolSessionClass::class, 'ssc_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
