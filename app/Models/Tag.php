<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    // 1. Map to your exact database table name
    protected $table = 'tag';

    // 2. Map to your custom capitalized Primary Key
    protected $primaryKey = 'tag_ID';

    // 3. Disable timestamps since your tag table doesn't have created_at/updated_at columns
    public $timestamps = false;

    // 4. Allow mass-assignment for the tag name field
    protected $fillable = [
        'tag_name'
    ];

    /**
     * Text Based Retrieval (TBR) Relationship
     * Synchronized to track pivot-layer collaborators and timestamps
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'image_tag', 'tag_ID', 'image_ID')
                    ->withPivot('user_ID');
    }
}