<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentGuardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'phone_number',
        'address',
        'nickname',
        'is_Delete',
    ];
}
