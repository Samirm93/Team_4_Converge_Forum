<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Converge - Where Ideas Meet</title>
    {{-- External CSS libraries for styling and icons --}}
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    {{-- BOOTSTRAP CSS - Load Bootstrap stylesheet from assets --}}
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-converge-primary">
    {{--
        Navigation component - contains links that connect to database:
        - Categories dropdown will query categories table
        - User profile links will query users table
        - Login/logout functionality affects user sessions
    --}}
    {{-- NAVIGATION COMPONENT - Include navbar with user authentication and categories --}}
    <x-navbar></x-navbar>

    {{-- Main content container with elegant spacing --}}
    <main class="container py-4">
        <div class="row g-4">

            {{-- Main content area with enhanced styling --}}
            <section class="col-lg-9">
                {{-- Header section with elegant dark theme styling --}}
                <div class="bg-white rounded-3 converge-shadow p-4 mb-4 border border-converge-light">
                    {{-- Desktop layout --}}
                    <div class="d-none d-lg-flex justify-content-between align-items-center">
                        {{-- Title section --}}
                        <div class="flex-shrink-0">
                            <h1 class="h4 text-converge-primary mb-0 fw-light me-5">
                                <i class="ion-chatbubble-working me-2 text-converge-accent-blue"></i>
                                What's on your mind?
                            </h1>
                        </div>

                        {{-- Button section - centered --}}
                        <div class="flex-shrink-0">
                            <a href="#" class="btn px-4 py-2 rounded-pill fw-medium btn-success btn-sm">
                                <i class="ion-compose me-2"></i>Create Post
                            </a>
                        </div>

                        {{-- Search bar section --}}
                        <div class="flex-grow-1 ms-4">
                            {{-- SEARCH FORM - Submit GET request to search posts --}}
                            <form id="searchBar" method="GET" action="/">
                                <div class="input-group">
                                    {{-- SEARCH INPUT - Text field with current search term value --}}
                                    <input class="form-control rounded-start-pill border-end-0"
                                           type="search"
                                           name="search"
                                           value="{{ $searchTerm }}"
                                           placeholder="Search discussions...">
                                    <button class="btn btn-outline-secondary rounded-end-pill border-start-0" type="submit">
                                        <i class="ion-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Mobile/Tablet layout --}}
                    <div class="d-lg-none">
                        <div class="row align-items-center g-3">
                            {{-- Title section --}}
                            <div class="col-md-12 col-12">
                                <h1 class="h4 text-converge-primary mb-0 fw-light text-center">
                                    <i class="ion-chatbubble-working me-2 text-converge-accent-blue"></i>
                                    What's on your mind?
                                </h1>
                            </div>
                            {{-- Button and Search row --}}
                            <div class="col-md-4 col-12 d-flex justify-content-center">
                                <a href="#" class="btn px-4 py-2 rounded-pill fw-medium btn-success">
                                    <i class="ion-compose me-2"></i>Create Post
                                </a>
                            </div>
                            <div class="col-md-8 col-12">
                                {{-- MOBILE SEARCH FORM - Submit GET request to search posts --}}
                                <form method="GET" action="/">
                                    <div class="input-group">
                                        {{-- MOBILE SEARCH INPUT - Text field with current search term value --}}
                                        <input class="form-control rounded-start-pill border-end-0"
                                               type="search"
                                               name="search"
                                               value="{{ $searchTerm }}"
                                               placeholder="Search discussions...">
                                        <button class="btn btn-outline-secondary rounded-end-pill border-start-0" type="submit">
                                            <i class="ion-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{--
                    Post layout component - displays posts from database
                    This component will loop through Post model data showing:
                    - post.title, post.content from posts table
                    - post.user.display_name from users table (via relationship)
                    - post.category.name from categories table (via relationship)
                    - post.likes_count, post.comments_count from posts table
                --}}
                {{-- Search results info --}}
                {{-- SEARCH RESULTS HEADER - Show search term and results count if searching --}}
                @if(!empty($searchTerm))
                    <div class="bg-white rounded-3 converge-shadow p-3 mb-4 border border-converge-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                <i class="ion-search me-2"></i>
                                {{-- SEARCH TERM OUTPUT - Display what user searched for --}}
                                Search results for: <strong>"{{ $searchTerm }}"</strong>
                                {{-- RESULTS COUNT - Show total number of matching posts --}}
                                ({{ $posts->total() }} {{ Str::plural('result', $posts->total()) }})
                            </span>
                            {{-- CLEAR SEARCH LINK - Return to all posts view --}}
                            <a href="/" class="btn btn-sm btn-outline-secondary">
                                <i class="ion-close me-1"></i>Clear Search
                            </a>
                        </div>
                    </div>
                {{-- END SEARCH CHECK --}}
                @endif

                {{-- POSTS LOOP - Display each post or show empty state --}}
                @forelse($posts as $post)
                    {{-- POST COMPONENT - Display individual post using post-layout component --}}
                    <x-post-layout :post="$post"></x-post-layout>
                {{-- EMPTY STATE - Show when no posts found --}}
                @empty
                    <div class="bg-white rounded-3 converge-shadow p-5 text-center border border-converge-light">
                        {{-- SEARCH EMPTY STATE - No posts match search term --}}
                        @if(!empty($searchTerm))
                            <i class="ion-sad text-muted" style="font-size: 3rem;"></i>
                            <h4 class="text-muted mt-3">No posts found</h4>
                            {{-- SEARCH TERM OUTPUT - Show what user searched for --}}
                            <p class="text-muted">No posts match your search for <strong>"{{ $searchTerm }}"</strong></p>
                            <a href="/" class="btn btn-outline-primary">
                                <i class="ion-arrow-left-c me-2"></i>Back to all posts
                            </a>
                        {{-- GENERAL EMPTY STATE - No posts exist at all --}}
                        @else
                            <i class="ion-document-text text-muted" style="font-size: 3rem;"></i>
                            <h4 class="text-muted mt-3">No posts yet</h4>
                            <p class="text-muted">Be the first to create a post!</p>
                        {{-- END SEARCH CHECK --}}
                        @endif
                    </div>
                {{-- END POSTS LOOP --}}
                @endforelse

                {{-- PAGINATION - Show page navigation if there are multiple pages --}}
                @if($posts->hasPages())
                    {{-- PAGINATION LINKS - Bootstrap pagination with preserved query parameters --}}
                    {{$posts->appends(request()->query())->links('vendor.pagination.bootstrap-5')}}
                {{-- END PAGINATION CHECK --}}
                @endif
            </section>

        {{-- Elegant sidebar with enhanced styling --}}
        <aside class="col-lg-3">
            {{-- Sidebar with refined design --}}
            <div>
                <div class="d-flex flex-column gap-4">
                    {{-- Minimal statistics section with dark theme --}}
                    <div class="bg-white rounded-3 converge-shadow overflow-hidden border border-converge-light">
                        <div class="p-4 border-bottom border-converge-light">
                            <h4 class="h5 text-converge-primary mb-0 fw-light text-center">
                                <i class="ion-stats-bars me-2 text-converge-accent-purple"></i>Community Stats
                            </h4>
                        </div>

                        <div class="row g-0">
                            <div class="col-6 p-4 border-end border-bottom border-converge-light text-center">
                                {{-- CATEGORIES COUNT - Total number of categories from database --}}
                                <div class="h4 text-converge-accent-blue mb-1 fw-light">{{count($categories)}}</div>
                                <div class="small text-muted">
                                    <i class="ion-filing me-1"></i>Categories
                                </div>
                            </div>
                            <div class="col-6 p-4 border-bottom border-converge-light text-center">
                                {{-- POSTS COUNT - Total number of posts from paginated collection --}}
                                <div class="h4 text-converge-accent-orange mb-1 fw-light">{{$posts->total()}}</div>
                                <div class="small text-muted">
                                    <i class="ion-document-text me-1"></i>Posts
                                </div>
                            </div>
                            <div class="col-6 p-4 border-end border-converge-light text-center">
                                {{-- USERS COUNT - Total number of registered users --}}
                                <div class="h4 text-converge-accent-green mb-1 fw-light">{{count($users)}}</div>
                                <div class="small text-muted">
                                    <i class="ion-person-stalker me-1"></i>Members
                                </div>
                            </div>
                            <div class="col-6 p-4 text-center">
                                {{-- LATEST USER - Display name of most recently registered user --}}
                                <div class="fw-normal text-converge-accent-purple mb-1">{{$latestuser->display_name}}</div>
                                <div class="small text-muted">
                                    <i class="ion-person-add me-1"></i>Newest Member
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Active Topics section with dark theme design --}}
                <div class="bg-white rounded-3 converge-shadow overflow-hidden border border-converge-light">
                    <div class="p-4 border-bottom border-converge-light">
                        <h4 class="h5 text-converge-primary mb-0 fw-light text-center">
                            <i class="ion-flame me-2 text-converge-accent-orange"></i>Most Liked
                        </h4>
                    </div>

                    {{-- MOST LIKED POSTS LOOP - Display top 10 posts by likes_count --}}
                    @forelse($mostLikedPosts as $post)
                        {{-- INDIVIDUAL POST ITEM - Single most liked post container --}}
                        <div class="p-4 border-bottom border-converge-light position-relative">
                            {{-- POST TITLE LINK - Clickable title that spans full container --}}
                            <h6 class="mb-2 fw-normal">
                                {{-- POST TITLE - Display the post title as a link --}}
                                <a href="#" class="text-converge-accent-blue text-decoration-none stretched-link">
                                    {{-- OUTPUT POST TITLE - Show the actual post title from database --}}
                                    {{ $post->title }}
                                </a>
                            </h6>
                            {{-- POST META INFO - Show likes count, time, and author --}}
                            <p class="mb-0 small text-muted">
                                {{-- LIKES ICON - Heart icon to indicate likes --}}
                                <i class="ion-heart me-1"></i>
                                {{-- LIKES COUNT - Show number of likes this post has --}}
                                <span>{{ $post->likes_count }} {{ Str::plural('like', $post->likes_count) }}</span>
                                {{-- SEPARATOR - Visual separator between likes and time --}}
                                <span class="mx-1">•</span>
                                {{-- TIME ICON - Clock icon for timestamp --}}
                                <i class="ion-clock me-1"></i>
                                {{-- POST TIME - Show how long ago the post was created --}}
                                <span>{{ $post->created_at->diffForHumans() }} by</span>
                                {{-- AUTHOR LINK - Link to the post author's profile --}}
                                <a href="#" class="text-converge-accent-green text-decoration-none ms-1">{{ $post->user->display_name }}</a>
                            </p>
                        </div>
                    {{-- EMPTY STATE - Show message when no posts have likes --}}
                    @empty
                        {{-- NO LIKED POSTS MESSAGE - Display when no posts have been liked --}}
                        <div class="p-4 text-center">
                            {{-- EMPTY ICON - Show document icon for empty state --}}
                            <i class="ion-document-text text-muted" style="font-size: 2rem;"></i>
                            {{-- EMPTY TITLE - Message explaining no liked posts --}}
                            <h6 class="text-muted mt-2 mb-0">No liked posts yet</h6>
                            {{-- EMPTY DESCRIPTION - Encourage users to start liking posts --}}
                            <p class="small text-muted mb-0">Posts will appear here when they receive likes</p>
                        </div>
                    {{-- END MOST LIKED POSTS LOOP --}}
                    @endforelse
                </div>

              </div>
            </div>
        </aside>
    </div>
</main>

{{-- BOOTSTRAP JS - Load Bootstrap JavaScript bundle from assets --}}
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
