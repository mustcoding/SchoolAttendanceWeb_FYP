<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\HasApiTokens; // Add this line

class Staff extends Authenticatable implements AuthenticatableContract
{

    use HasFactory,Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'username',
        'password',
        'position',
        'nickname',
        'image',
        'is_Delete',
    ];

    public function schoolSessionClasses() {
        return $this->hasMany(SchoolSessionClass::class, 'staff_id');
    }

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
