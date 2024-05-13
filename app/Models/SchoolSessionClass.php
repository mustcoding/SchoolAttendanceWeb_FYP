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
}
