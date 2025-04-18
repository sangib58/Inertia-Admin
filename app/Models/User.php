<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table='users';
    protected $primaryKey = 'userId';
    const CREATED_AT = 'dateAdded';
    const UPDATED_AT = 'lastUpdatedDate';

    protected $fillable=['userRoleId','fullName','email','password','mobile','dateOfBirth','imagePath','addedBy'];

    protected $hidden=['password'];

    protected $casts=[
        'password'=>'hashed',
    ];
}
