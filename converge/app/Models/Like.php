<?php
// LIKE MODEL - Represents likes table for polymorphic liking system

namespace App\Models;

// Import factory trait for creating test data
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import base Model class with database methods
use Illuminate\Database\Eloquent\Model;

// LIKE MODEL CLASS - Handles likes on posts, comments, etc.
class Like extends Model
{
    // USE FACTORY - Enable creating fake likes for testing
    use HasFactory;
    
    // ENABLE TIMESTAMPS - Track when likes are created
    public $timestamps = true;
    
    // DISABLE UPDATED_AT - Only track creation time, likes don't get updated
    const UPDATED_AT = null;

    // FILLABLE FIELDS - Columns safe for mass assignment
    protected $fillable = [
        // USER ID - Foreign key linking to users table (who liked)
        'user_id',
        // LIKEABLE TYPE - Class name of liked item (Post, Comment, etc.)
        'likeable_type',
        // LIKEABLE ID - ID of the specific record being liked
        'likeable_id',
    ];

    // USER RELATIONSHIP - Define connection to User model
    public function user()
    {
        // BELONGS TO ONE USER - Each like has one author
        return $this->belongsTo(User::class);
    }

    // POLYMORPHIC RELATIONSHIP - Define connection to any likeable model
    public function likeable()
    {
        // MORPH TO - Can link to Post, Comment, or other models
        return $this->morphTo();
    }
}
