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

}
