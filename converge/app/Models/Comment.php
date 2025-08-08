<?php
// COMMENT MODEL - Represents comments table for post discussions

namespace App\Models;

// Import factory trait for creating test data
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import base Model class with database methods
use Illuminate\Database\Eloquent\Model;

// COMMENT MODEL CLASS - Handles threaded comments and replies
class Comment extends Model
{
    // USE FACTORY - Enable creating fake comments for testing
    use HasFactory;
    
    // FILLABLE FIELDS - Columns safe for mass assignment
    protected $fillable = [
        // CONTENT - The actual comment text
        'content',
        // USER ID - Foreign key linking to users table (who wrote this)
        'user_id',
        // POST ID - Foreign key linking to posts table (which post)
        'post_id',
        // PARENT ID - Foreign key for replies (null for top-level comments)
        'parent_id',
        // LIKES COUNT - Number of likes this comment received
        'likes_count',
    ];

    // USER RELATIONSHIP - Define connection to User model
    public function user()
    {
        // BELONGS TO ONE USER - Each comment has one author
        return $this->belongsTo(User::class);
    }

    // POST RELATIONSHIP - Define connection to Post model
    public function post()
    {
        // BELONGS TO ONE POST - Each comment belongs to one post
        return $this->belongsTo(Post::class);
    }

    // PARENT RELATIONSHIP - Define self-referential connection for replies
    public function parent()
    {
        // BELONGS TO PARENT COMMENT - Links to comment being replied to
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // REPLIES RELATIONSHIP - Define self-referential connection for nested comments
    public function replies()
    {
        // HAS MANY REPLIES - One comment can have multiple replies
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // LIKES RELATIONSHIP - Define polymorphic connection to Like model
    public function likes()
    {
        // MORPH MANY LIKES - One comment can have many likes (polymorphic)
        return $this->morphMany(Like::class, 'likeable');
    }
}
