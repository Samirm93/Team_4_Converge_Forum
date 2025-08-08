<?php
// DATABASE SEEDER - Populates database with fake data for testing

namespace Database\Seeders;

// Import all Model classes for creating fake data
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
// Import base Seeder class
use Illuminate\Database\Seeder;

// DATABASE SEEDER CLASS - Creates test data using factories
class DatabaseSeeder extends Seeder
{
    // RUN METHOD - Executes when "php artisan db:seed" is called
    public function run(): void
    {
        // CREATE 10 USERS - Generate fake user accounts using UserFactory
        $users = User::factory(10)->create();

        // CREATE 10 CATEGORIES - Generate fake categories using CategoryFactory
        $categories = Category::factory(10)->create();

        // CREATE 10 POSTS - Generate fake posts linking to random users and categories
        $posts = Post::factory(10)->create([
            // RANDOM USER - Pick random user ID from created users
            'user_id' => $users->random()->id,
            // RANDOM CATEGORY - Pick random category ID from created categories
            'category_id' => $categories->random()->id,
        ]);

        // CREATE 10 COMMENTS - Generate fake comments linking to random users and posts
        $comments = Comment::factory(10)->create([
            // RANDOM USER - Pick random user ID for comment author
            'user_id' => $users->random()->id,
            // RANDOM POST - Pick random post ID to comment on
            'post_id' => $posts->random()->id,
        ]);

        // CREATE 5 POST LIKES - Loop to create likes on random posts
        for ($i = 0; $i < 5; $i++) {
            // CREATE OR FIND LIKE - Avoid duplicate likes (same user+post)
            Like::firstOrCreate([
                // RANDOM USER - Pick random user ID who likes
                'user_id' => $users->random()->id,
                // LIKE TYPE - Specify this is a Post like (polymorphic)
                'likeable_type' => 'App\Models\Post',
                // RANDOM POST - Pick random post ID to like
                'likeable_id' => $posts->random()->id,
            ]);
        }

        // CREATE 5 COMMENT LIKES - Loop to create likes on random comments
        for ($i = 0; $i < 5; $i++) {
            // CREATE OR FIND LIKE - Avoid duplicate likes (same user+comment)
            Like::firstOrCreate([
                // RANDOM USER - Pick random user ID who likes
                'user_id' => $users->random()->id,
                // LIKE TYPE - Specify this is a Comment like (polymorphic)
                'likeable_type' => 'App\Models\Comment',
                // RANDOM COMMENT - Pick random comment ID to like
                'likeable_id' => $comments->random()->id,
            ]);
        }
    }
}
