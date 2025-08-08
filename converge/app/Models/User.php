<?php
// USER MODEL - Represents users table and handles authentication

namespace App\Models;

// Import factory trait for creating test data
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import authenticatable base class for login functionality
use Illuminate\Foundation\Auth\User as Authenticatable;
// Import notification trait for sending emails/messages
use Illuminate\Notifications\Notifiable;

// USER MODEL CLASS - Handles user authentication and data
class User extends Authenticatable
{
    // USE TRAITS - Add factory and notification capabilities
    use HasFactory, Notifiable;

    // FILLABLE FIELDS - Columns safe for mass assignment
    protected $fillable = [
        // USERNAME - Unique identifier for login
        'username',
        // EMAIL - User's email for login and notifications
        'email',
        // PASSWORD HASH - Encrypted password for security
        'password_hash',
        // DISPLAY NAME - User's public name shown on posts
        'display_name',
        // BIO - Optional user description
        'bio',
        // AVATAR PATH - Optional profile picture file path
        'avatar_path',
    ];

    // HIDDEN FIELDS - Never include these in JSON responses
    protected $hidden = [
        // PASSWORD HASH - Never send password in API responses
        'password_hash',
        // REMEMBER TOKEN - Keep login tokens private
        'remember_token',
    ];

    // CAST ATTRIBUTES - Convert database values to PHP types
    protected function casts(): array
    {
        return [
            // EMAIL VERIFIED AT - Convert to Carbon datetime object
            'email_verified_at' => 'datetime',
            // PASSWORD HASH - Automatically hash when saving
            'password_hash' => 'hashed',
        ];
    }

    // GET AUTH PASSWORD - Return password field for Laravel authentication
    public function getAuthPassword()
    {
        // RETURN PASSWORD HASH - Laravel needs this for login verification
        return $this->password_hash;
    }

    // GET REMEMBER TOKEN NAME - Tell Laravel which field stores remember tokens
    public function getRememberTokenName()
    {
        // RETURN TOKEN FIELD - Laravel stores "remember me" tokens here
        return 'remember_token';
    }

    // POSTS RELATIONSHIP - Define connection to Post model
    public function posts()
    {
        // HAS MANY POSTS - One user can write multiple posts
        return $this->hasMany(Post::class);
    }

    // COMMENTS RELATIONSHIP - Define connection to Comment model
    public function comments()
    {
        // HAS MANY COMMENTS - One user can write multiple comments
        return $this->hasMany(Comment::class);
    }

    // LIKES RELATIONSHIP - Define connection to Like model
    public function likes()
    {
        // HAS MANY LIKES - One user can like multiple things
        return $this->hasMany(Like::class);
    }
}
