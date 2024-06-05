<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentSupportingDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'document_path',
        'uploaded_date_time',
        'verification_status',
        'verified_date_time',
        'reason',
        'parent_guardian_id',
        'staff_id',
        'is_Delete',
        'start_date_leave',
        'end_date_leave',
    ];


     public function student()
     {
         return $this->belongsTo(Student::class, 'student_id', 'id');
     }

     public function parentGuardian()
    {
        return $this->belongsTo(ParentGuardian::class);
    }
}
