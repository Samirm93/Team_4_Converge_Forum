<?php
// CATEGORY MODEL - Represents categories table for organizing posts

namespace App\Models;

// Import factory trait for creating test data
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import base Model class with database methods
use Illuminate\Database\Eloquent\Model;

// CATEGORY MODEL CLASS - Handles post categorization
class Category extends Model
{
    // USE FACTORY - Enable creating fake categories for testing
    use HasFactory;
    
    // ENABLE TIMESTAMPS - Track when categories are created
    public $timestamps = true;
    
    // DISABLE UPDATED_AT - Only track creation time, not updates
    const UPDATED_AT = null;

    // FILLABLE FIELDS - Columns safe for mass assignment
    protected $fillable = [
        // CATEGORY NAME - Display name like "Technology" or "Sports"
        'name',
        // DESCRIPTION - Optional explanation of category purpose
        'description',
    ];

    // POSTS RELATIONSHIP - Define connection to Post model
    public function posts()
    {
        // HAS MANY POSTS - One category can contain multiple posts
        return $this->hasMany(Post::class);
    }
}
