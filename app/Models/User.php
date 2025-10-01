<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'budget',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'budget' => 'float',
    ];

    // Relations
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Helpers budget
    public function addToBudget($amount)
    {
        $this->budget += $amount;
        $this->save();
    }

    public function subtractFromBudget($amount)
    {
        $this->budget -= $amount;
        $this->save();
    }

    // Implémentation JWT
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
