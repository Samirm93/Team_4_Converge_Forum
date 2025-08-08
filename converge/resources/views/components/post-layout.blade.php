{{-- POST ARTICLE CONTAINER - Main post display component --}}
<article class="bg-white rounded-3 converge-shadow mb-4 overflow-hidden position-relative"
         style="transition: all 0.2s ease-in-out; border-left: 4px solid var(--converge-accent-blue);">

    <div class="p-4">
        <div class="row align-items-start">
            {{-- Enhanced left column: Post title and metadata --}}
            <div class="col-md-8 mb-3 mb-md-0">
                {{-- Post title with improved typography --}}
                <h5 class="mb-4 mt-2">
                    {{-- POST TITLE LINK - Clickable title that links to full post --}}
                    <a href="#" class="text-converge-accent-blue text-decoration-none fw-normal stretched-link"
                       style="line-height: 1.4;">
                        {{-- POST TITLE OUTPUT - Display the post title --}}
                        {{$post->title}}
                    </a>
                </h5>

                {{-- Enhanced metadata section --}}
                <div class="d-flex align-items-center gap-3 text-muted small">
                    <div class="d-flex align-items-center">
                        <i class="ion-person me-2"></i>
                        {{-- AUTHOR LINK - Link to post author's profile --}}
                        <a href="#" class="text-converge-accent-green text-decoration-none fw-normal">{{$post->user->display_name}}</a>
                    </div>

                    <div class="d-flex align-items-center">
                        <i class="ion-clock me-2"></i>
                        {{-- CREATION DATE - When the post was created --}}
                        <span>Created at: {{$post->created_at->diffForHumans()}}</span>
                    </div>



                </div>
            </div>

            {{-- Enhanced right column: Statistics with modern icons and layout --}}
            <div class="col-md-4">
                <div class="row g-3 text-center">
                    {{-- Votes/Likes section with enhanced styling --}}
                    <div class="col-4">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2"
                                 style="width: 40px; height: 40px; background-color: var(--converge-surface); color: var(--converge-accent-blue);">
                                <i class="ion-thumbsup" style="font-size: 1.1rem;"></i>
                            </div>
                            {{-- LIKES COUNT - Number of likes this post has received --}}
                            <div class="fw-light text-converge-accent-blue">{{$post->likes_count}}</div>
                            <div class="small text-muted">Likes</div>
                        </div>
                    </div>

                    {{-- Comments section --}}
                    <div class="col-4">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2"
                                 style="width: 40px; height: 40px; background-color: var(--converge-surface); color: var(--converge-accent-orange);">
                                <i class="ion-chatbubbles" style="font-size: 1.1rem;"></i>
                            </div>
                            {{-- COMMENTS COUNT - Number of comments on this post --}}
                            <div class="fw-light text-converge-accent-orange">{{$post->comments_count}}</div>
                            <div class="small text-muted">Replies</div>
                        </div>
                    </div>

                    {{-- Views section --}}
                    <div class="col-4">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2"
                                 style="width: 40px; height: 40px; background-color: var(--converge-surface); color: var(--converge-accent-green);">
                                <i class="ion-eye" style="font-size: 1.1rem;"></i>
                            </div>
                            {{-- VIEWS COUNT - Random number of views (placeholder) --}}
                            <div class="fw-light text-converge-accent-green">{{ rand(10, 500) }}</div>
                            <div class="small text-muted">Views</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- END POST ARTICLE --}}
</article>

