<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Importer ceci

class User extends Authenticatable // Étendre Authenticatable au lieu de Model
{
    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}