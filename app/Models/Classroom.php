<?php

namespace App\Models;
use App\Models\SchoolSessionClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'form_number',
        'max_capacity',
        'is_Delete',
    ];

    public function schoolSessionClasses()
    {
        return $this->hasMany(SchoolSessionClass::class, 'class_id');
    }
    
    public function students()
    {
        return $this->hasManyThrough(StudentStudySession::class, SchoolSessionClass::class, 'class_id', 'ssc_id');
    }
}
