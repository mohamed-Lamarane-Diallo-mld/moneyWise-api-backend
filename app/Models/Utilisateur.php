<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;


    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'budget',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relation : un utilisateur peut avoir plusieurs catégories
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // Implémentation JWT
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
