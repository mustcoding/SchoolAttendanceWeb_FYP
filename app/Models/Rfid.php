<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'is_Delete',
    ];

  
    public function students()
    {
        return $this->hasMany(Student::class, 'card_rfid');
    }

    public function tagStudents()
    {
        return $this->hasMany(Student::class, 'tag_rfid');
    }
}
