<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    protected $table = 'image'; // Matches your database table name
    protected $primaryKey = 'image_ID'; // Matches your PK
    public $timestamps = true; // Kept active since created_at/updated_at exist

    protected $fillable = [
        'user_ID', // Fixed case to match your database column exactly
        'file_name', 
        'file_size', 
        'upload_date', 
        'image_format', 
        'description'
    ];

    /**
     * Relationship to the uploading User (e.g., Afiq who uploaded it)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_ID', 'user_ID');
    }

    /**
     * Relationship to Content-Based Features (CBR / ABR)
     */
    public function visualFeature(): HasOne
    {
        return $this->hasOne(VisualFeature::class, 'image_ID', 'image_ID');
    }

    /**
     * Relationship to Text-Based Retrieval Tags (TBR)
     * Updated to track the comment author (user_ID) on the pivot table
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'image_tag', 'image_ID', 'tag_ID')
                    ->withPivot('user_ID');
    }
}