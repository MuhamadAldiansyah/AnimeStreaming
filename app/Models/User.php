<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\UserType;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'profile_photo'
    ];

    // Metode untuk memetakan tipe user
    use Notifiable;
  
    // ...

    public function getTypeAttribute($value)
    {
        return UserType::from($value);
    }
}

