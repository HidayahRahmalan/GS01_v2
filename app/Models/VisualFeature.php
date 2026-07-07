<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisualFeature extends Model
{
    protected $table = 'visual_feature';
    protected $primaryKey = 'feature_ID';
    public $timestamps = false;

    protected $fillable = [
        'image_ID', 'clothing_type', 'background_type', 
        'background_color', 'face_position', 'camera_posture', 'body_composition'
    ];
}