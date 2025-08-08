{{--
    Enhanced Navigation bar component for Converge application
    Modern design with consistent theming and improved user experience
--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-converge-secondary converge-shadow-lg sticky-top"
     style="border-bottom: 1px solid var(--converge-border-light); backdrop-filter: blur(10px);">
    {{-- Container with enhanced spacing --}}
    <div class="container">
        {{-- Enhanced brand with modern styling --}}
        <a class="navbar-brand fw-light d-flex align-items-center" href="/"
           style="color: var(--converge-text-primary); font-size: 1.5rem;">
            <div class="d-flex align-items-center justify-content-center me-2"
                 style="width: 40px; height: 40px; background: transparent;">
                <img src="/images/converge_logo.png" alt="Converga Logo"
                     style="width: 36px; height: 36px; object-fit: contain;">
            </div>
           Converge
        </a>

        {{-- Enhanced mobile toggle with custom styling --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" >
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Enhanced collapsible navbar content --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Refined primary navigation links --}}
            <ul class="navbar-nav me-auto">
                {{-- Enhanced Home link --}}
                <li class="nav-item">
                    <a class="nav-link fw-normal px-3 py-2 rounded-pill position-relative"
                       href="/" style="color: var(--converge-text-secondary); transition: all 0.2s;">
                        <i class="ion-home me-2"></i>Home
                    </a>
                </li>

                {{-- Enhanced Categories dropdown --}}
                <li class="nav-item dropdown">
                    {{-- CATEGORIES DROPDOWN TRIGGER - Show categories menu --}}
                    <a class="nav-link dropdown-toggle fw-normal px-3 py-2 rounded-pill"
                       href="#" id="categoriesDropdown"  data-bs-toggle="dropdown"
                        style="color: var(--converge-text-secondary); transition: all 0.2s;">
                        <i class="ion-filing me-2"></i>Categories
                    </a>
                    {{-- CATEGORIES DROPDOWN MENU - List of post categories --}}
                    <ul class="dropdown-menu border-0 converge-shadow mt-2"
                                                style="border-radius: 12px; min-width: 200px;">
                        <li>
                            {{-- TECHNOLOGY CATEGORY LINK --}}
                            <a class="dropdown-item rounded py-2" href="/category/technology"
                               style="color: var(--converge-text-primary);">
                                <i class="ion-code me-2 text-converge-accent-blue"></i>Technology
                            </a>
                        </li>
                        <li>
                            {{-- DESIGN CATEGORY LINK --}}
                            <a class="dropdown-item rounded py-2" href="/category/design"
                               style="color: var(--converge-text-primary);">
                                <i class="ion-paintbrush me-2 text-converge-accent-orange"></i>Design
                            </a>
                        </li>
                        <li>
                            {{-- BUSINESS CATEGORY LINK --}}
                            <a class="dropdown-item rounded py-2" href="/category/business"
                               style="color: var(--converge-text-primary);">
                                <i class="ion-briefcase me-2 text-converge-accent-green"></i>Business
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            {{-- ALL CATEGORIES LINK --}}
                            <a class="dropdown-item rounded py-2 fw-normal" href="/categories"
                               style="color: var(--converge-accent-purple);">
                                <i class="ion-grid me-2"></i>All Categories
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Enhanced Popular link --}}
                <li class="nav-item">
                    <a class="nav-link fw-normal px-3 py-2 rounded-pill"
                       href="#" style="color: var(--converge-text-secondary); transition: all 0.2s;">
                        <i class="ion-flame me-2"></i>Popular
                    </a>
                </li>

                {{-- Enhanced Recent link --}}
                <li class="nav-item">
                    <a class="nav-link fw-normal px-3 py-2 rounded-pill"
                       href="#" style="color: var(--converge-text-secondary); transition: all 0.2s;">
                        <i class="ion-clock me-2"></i>Recent
                    </a>
                </li>
            </ul>

            {{-- Enhanced right-side navigation --}}
            <div class="d-flex align-items-center gap-3">

                {{-- Enhanced user authentication section --}}
                <div class="d-flex align-items-center gap-2">
                    {{-- Create Post button with modern design --}}
                    {{-- AUTHENTICATED USER SECTION - Show user menu when logged in --}}
                @auth
                        {{-- Enhanced User dropdown (when logged in) --}}
                        <div class="nav-item dropdown">
                            {{-- USER DROPDOWN TRIGGER - Shows user avatar and name --}}
                            <a class="nav-link dropdown-toggle d-flex align-items-center px-3 py-2 rounded-pill fw-normal"
                               href="#" id="userDropdown"  data-bs-toggle="dropdown"
                                style="color: var(--converge-text-secondary); transition: all 0.2s;">
                                <div class="rounded-circle me-2 d-flex align-items-center justify-content-center"
                                     style="width: 32px; height: 32px; background: linear-gradient(135deg, var(--converge-accent-blue), var(--converge-accent-purple));">
                                    <i class="ion-person text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                {{-- USER DISPLAY NAME - Show logged in user's display name --}}
                                <span class="d-none d-md-inline">{{ Auth::user()->display_name }}</span>
                            </a>
                            {{-- USER DROPDOWN MENU - Profile and logout options --}}
                            <ul class="dropdown-menu dropdown-menu-end border-0 converge-shadow mt-2"
                                                                style="border-radius: 12px; min-width: 200px;">
                                <li>
                                    {{-- PROFILE LINK - Navigate to user profile edit page --}}
                                    <a class="dropdown-item rounded py-2" href="{{ route('profile.edit') }}"
                                       style="color: var(--converge-text-primary);">
                                        <i class="ion-person me-2 text-converge-accent-blue"></i>My Profile
                                    </a>
                                </li>
                                <li>
                                    {{-- MY POSTS LINK - Navigate to user's posts --}}
                                    <a class="dropdown-item rounded py-2" href="/posts/my"
                                       style="color: var(--converge-text-primary);">
                                        <i class="ion-document-text me-2 text-converge-accent-orange"></i>My Posts
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    {{-- LOGOUT FORM - Submit form to logout user --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        {{-- CSRF TOKEN - Security token for logout request --}}
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded py-2 w-100 text-start border-0 bg-transparent"
                                               style="color: var(--converge-text-primary);">
                                            <i class="ion-log-out me-2 text-converge-accent-orange"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    {{-- GUEST USER SECTION - Show login/register when not authenticated --}}
                    @else
                    {{-- Search section - takes more space --}}
                    <div class="d-flex justify-content-between">

                        {{-- Enhanced Login/Register buttons (when not logged in) --}}
                        <div class="d-flex align-items-center gap-2">
                            {{-- LOGIN LINK - Navigate to login page --}}
                            <a href="{{ route('login') }}" class="btn btn-link fw-medium px-3 py-2 rounded-pill text-decoration-none btn-outline-secondary">
                                <i class="ion-log-in me-2"></i>Login
                            </a>
                            {{-- REGISTER LINK - Navigate to registration page --}}
                            <a href="{{ route('register') }}" class="btn px-3 py-2 rounded-pill fw-medium btn btn-outline-success">
                                <i class="ion-person-add me-2"></i>Register
                            </a>
                        </div>
                        </div>
                    {{-- END AUTH CHECK --}}
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
