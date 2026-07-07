<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageEntry extends Model
{
    // Add this to allow mass assignment of your fields
    protected $fillable = [
        'path', 
        'abr', 
        'cbr', 
        'tbr'
    ];
}