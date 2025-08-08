{{-- USE GUEST LAYOUT - Display login form inside guest template --}}
<x-guest-layout>

{{-- EMPTY SPACE - Add visual spacing before content --}}

    {{-- SESSION STATUS CHECK - Show success/info messages if they exist --}}
    @if (session('status'))
        {{-- STATUS MESSAGE BOX - Display styled alert with session status --}}
        <div class="alert alert-info mb-4" style="background-color: var(--converge-surface); border-color: var(--converge-accent-blue); color: var(--converge-text-primary);">
            {{-- OUTPUT STATUS - Show the actual status message --}}
            {{ session('status') }}
        {{-- END STATUS BOX --}}
        </div>
    {{-- END STATUS CHECK --}}
    @endif

    {{-- LOGIN FORM - Main form for user authentication --}}
    <form method="POST" action="{{ route('login') }}">
        {{-- CSRF TOKEN - Security token to prevent cross-site attacks --}}
        @csrf

        {{-- USERNAME SECTION - Input field for username --}}
        <div class="mb-3">
            {{-- USERNAME LABEL - Text label for username input --}}
            <label for="username" class="form-label text-converge-primary fw-medium">
                {{-- LABEL TEXT - Display "Username" text --}}
                Username
            {{-- END LABEL --}}
            </label>
            {{-- USERNAME INPUT - Text field for entering username --}}
            <input id="username" type="text" name="username"
                   class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}"
                   required autofocus autocomplete="username"
                   placeholder="Enter your username">
            {{-- USERNAME ERROR CHECK - Show error message if username validation fails --}}
            @error('username')
                {{-- ERROR MESSAGE BOX - Display username error in red box --}}
                <div class="invalid-feedback">
                    {{-- ERROR TEXT - Show the actual error message --}}
                    {{ $message }}
                {{-- END ERROR BOX --}}
                </div>
            {{-- END ERROR CHECK --}}
            @enderror
        {{-- END USERNAME SECTION --}}
        </div>

        {{-- PASSWORD SECTION - Input field for password --}}
        <div class="mb-3">
            {{-- PASSWORD LABEL - Text label for password input --}}
            <label for="password" class="form-label text-converge-primary fw-medium">
                {{-- LABEL TEXT - Display "Password" text --}}
                Password
            {{-- END LABEL --}}
            </label>
            {{-- PASSWORD INPUT - Hidden text field for entering password --}}
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password"
                   placeholder="Enter your password">
            {{-- PASSWORD ERROR CHECK - Show error message if password validation fails --}}
            @error('password')
                {{-- ERROR MESSAGE BOX - Display password error in red box --}}
                <div class="invalid-feedback">
                    {{-- ERROR TEXT - Show the actual error message --}}
                    {{ $message }}
                {{-- END ERROR BOX --}}
                </div>
            {{-- END ERROR CHECK --}}
            @enderror
        {{-- END PASSWORD SECTION --}}
        </div>

{{-- EMPTY SPACE - Add visual spacing before submit button --}}

        {{-- SUBMIT BUTTON SECTION - Container for login button --}}
        <div class="d-grid gap-2">
            {{-- LOGIN BUTTON - Submit button to process login --}}
            <button type="submit" class="btn btn-primary fw-medium mt-3"
                    style="background-color: var(--converge-accent-blue); border-color: var(--converge-accent-blue);">
                {{-- BUTTON ICON - Login icon before text --}}
                <i class="ion-log-in me-2"></i>Sign In
            {{-- END BUTTON --}}
            </button>
        {{-- END BUTTON SECTION --}}
        </div>

        {{-- REGISTER LINK SECTION - Link to registration page --}}
        <div class="text-center mt-2">
            {{-- HELPER TEXT - Prompt for new users --}}
            <span class="text-muted small">Don't have an account? </span>
            {{-- REGISTER LINK - Link to create new account --}}
            <a href="{{ route('register') }}" class="text-decoration-none fw-medium"
               style="color: var(--converge-accent-green);">
                {{-- LINK TEXT - Text for registration link --}}
                Create one here
            {{-- END LINK --}}
            </a>
        {{-- END LINK SECTION --}}
        </div>
    {{-- END FORM --}}
    </form>
{{-- END LAYOUT --}}
</x-guest-layout>
