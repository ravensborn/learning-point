<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable  implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const roles = [
        'system admin', 'accountant'
    ];


    public static function getAvatarsArray($gender): array
    {
        return [
            public_path('images/avatars/' . $gender . '-1.png'),
            public_path('images/avatars/' . $gender . '-2.png'),
            public_path('images/avatars/' . $gender . '-3.png'),
            public_path('images/avatars/' . $gender . '-4.png'),
            public_path('images/avatars/' . $gender . '-5.png'),
        ];
    }
}
