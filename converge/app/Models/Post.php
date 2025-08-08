<?php
// POST MODEL - Represents posts table in database

namespace App\Models;

// Import factory trait for creating test data
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import base Model class with database methods
use Illuminate\Database\Eloquent\Model;

// POST MODEL CLASS - Handles posts table operations
class Post extends Model
{
    // USE FACTORY - Enable creating fake posts for testing
    use HasFactory;
    
    // FILLABLE FIELDS - Columns that can be mass-assigned for security
    protected $fillable = [
        // POST TITLE - The main heading of the post
        'title',
        // POST CONTENT - The body text of the post
        'content',
        // IMAGE PATH - Optional file path to uploaded image
        'image_path',
        // USER ID - Foreign key linking to users table (who wrote this)
        'user_id',
        // CATEGORY ID - Foreign key linking to categories table
        'category_id',
        // LIKES COUNT - Number of likes this post has received
        'likes_count',
        // COMMENTS COUNT - Number of comments on this post
        'comments_count',
    ];

    // USER RELATIONSHIP - Define connection to User model
    public function user()
    {
        // BELONGS TO ONE USER - Each post has one author
        return $this->belongsTo(User::class);
    }

    // CATEGORY RELATIONSHIP - Define connection to Category model
    public function category()
    {
        // BELONGS TO ONE CATEGORY - Each post fits in one category
        return $this->belongsTo(Category::class);
    }

    // COMMENTS RELATIONSHIP - Define connection to Comment model
    public function comments()
    {
        // HAS MANY COMMENTS - One post can have multiple comments
        return $this->hasMany(Comment::class);
    }

    // LIKES RELATIONSHIP - Define polymorphic connection to Like model
    public function likes()
    {
        // MORPH MANY LIKES - One post can have many likes (polymorphic)
        return $this->morphMany(Like::class, 'likeable');
    }
}
