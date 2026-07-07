<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Database configuration
    protected $table = 'users'; // Explicitly set the table name
    protected $primaryKey = 'user_ID'; // Your custom primary key
    public $incrementing = true; 
    protected $keyType = 'int';
    public $timestamps = true; // Set to true since you have created_at/updated_at

    // Mass assignment protection
    protected $fillable = [
        'username',
        // 💡 Kept 'email' here just in case it exists in your database table, 
        // but it's no longer required during registration processing.
        'email', 
        'password',
    ];

    // Hidden attributes for security
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Data type casting
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}