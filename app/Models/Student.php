<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParentGuardian;
use App\Models\Rfid;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'parent_guardian_id',
        'card_rfid',
        'tag_rfid',
        'is_Delete',
        'type_student',
    ];

    public function cardRfid()
    {
        return $this->belongsTo(Rfid::class, 'card_rfid');
    }

    public function tagRfid()
    {
        return $this->belongsTo(Rfid::class, 'tag_rfid');
    }

    public function parentGuardian()
    {
        return $this->belongsTo(ParentGuardian::class, 'parent_guardian_id');
    }

    public function studentStudySessions()
    {
        return $this->hasMany(StudentStudySession::class, 'student_id');
    }

    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class, StudentStudySession::class, 'student_id', 'id', 'id', 'ssc_id');
    }



}
