<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ParentGuardian extends Authenticatable implements AuthenticatableContract
{
    use HasFactory,Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'username',
        'password',
        'phone_number',
        'address',
        'nickname',
        'is_Delete',
    ];

    public function studentStudySessions()
    {
        return $this->hasMany(StudentStudySession::class);
    }
}
