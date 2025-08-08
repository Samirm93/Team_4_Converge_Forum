<?php
// START OF CONTROLLER - Handles user requests and returns responses

namespace App\Http\Controllers;
// Import Model classes to interact with database tables
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
// Import Request class to handle HTTP requests (GET, POST data)
use Illuminate\Http\Request;
// Import String helper for text manipulation
use Illuminate\Support\Str;

// CONTROLLER CLASS - Processes requests and prepares data for views
class HomeController extends Controller
{
    // INDEX METHOD - Handles home page requests
    public function index(Request $request) {
    // BUILD QUERY - Start with Post model, load user & category relationships, order by newest
    $query = Post::with(['user', 'category'])->latest();

    // CHECK FOR SEARCH - If user submitted search form
    if ($request->has('search') && !empty($request->search)) {
        // GET SEARCH TERM - Extract search text from form input
        $searchTerm = $request->search;
        // FILTER POSTS - Add WHERE clause to find posts with matching title
        $query->where('title', 'LIKE', '%' . $searchTerm . '%');
    }
    
    // EXECUTE QUERIES - Get filtered posts with pagination (10 per page)
    $posts = $query->paginate(10);
    // GET ALL CATEGORIES - Fetch every category from database
    $categories = Category::all();
    // GET ALL USERS - Fetch every user from database
    $users = User::all();
    // GET LATEST USER - Find most recently registered user for sidebar
    $latestuser = User::latest()->first();
    // GET MOST LIKED POSTS - Fetch 10 posts ordered by highest likes_count first
    $mostLikedPosts = Post::with(['user', 'category'])
        // Order by likes_count in descending order (highest first)
        ->orderBy('likes_count', 'desc')
        // Limit results to only 10 posts
        ->take(10)
        // Execute the query and get the collection
        ->get();

    // PREPARE SEARCH TERM - Set search term or empty string for view
    $searchTerm = $request->search ?? '';

    // RETURN VIEW - Send home.blade.php with data variables including most liked posts
    return view('home', compact('posts', 'categories', 'users', 'latestuser', 'searchTerm', 'mostLikedPosts'));
}
}
