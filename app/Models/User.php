<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function likes() {
        return $this->hasMany(Like::class);
    }
    
    public function toSearchableArray() {
        return [
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
        ];
    }
    

}
