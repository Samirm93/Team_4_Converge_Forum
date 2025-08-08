{{-- USE GUEST LAYOUT - Display registration form inside guest template with title --}}
<x-guest-layout title="Register">


    {{-- REGISTRATION FORM - Main form for creating new user accounts --}}
    <form method="POST" action="{{ route('register') }}">
        {{-- CSRF TOKEN - Security token to prevent cross-site attacks --}}
        @csrf

        <div class="row">
            <!-- Username -->
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label text-converge-primary fw-medium">
                    Username
                </label>
                {{-- USERNAME INPUT - Text field with validation and old value restoration --}}
                <input id="username" type="text" name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username') }}"
                       required autofocus autocomplete="username"
                       placeholder="Choose a username">
                {{-- USERNAME ERROR CHECK - Show error message if username validation fails --}}
                @error('username')
                    <div class="invalid-feedback">
                        {{-- ERROR OUTPUT - Display the validation error message --}}
                        {{ $message }}
                    </div>
                {{-- END ERROR CHECK --}}
                @enderror
            </div>

            <!-- Display Name -->
            <div class="col-md-6 mb-3">
                <label for="display_name" class="form-label text-converge-primary fw-medium">
                    Display Name
                </label>
                {{-- DISPLAY NAME INPUT - Text field with validation and old value restoration --}}
                <input id="display_name" type="text" name="display_name"
                       class="form-control @error('display_name') is-invalid @enderror"
                       value="{{ old('display_name') }}"
                       required
                       placeholder="Your display name">
                {{-- DISPLAY NAME ERROR CHECK - Show error message if display name validation fails --}}
                @error('display_name')
                    <div class="invalid-feedback">
                        {{-- ERROR OUTPUT - Display the validation error message --}}
                        {{ $message }}
                    </div>
                {{-- END ERROR CHECK --}}
                @enderror
            </div>
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label text-converge-primary fw-medium">
                Email Address
            </label>
            {{-- EMAIL INPUT - Email field with validation and old value restoration --}}
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   required autocomplete="email"
                   placeholder="your@email.com">
            {{-- EMAIL ERROR CHECK - Show error message if email validation fails --}}
            @error('email')
                <div class="invalid-feedback">
                    {{-- ERROR OUTPUT - Display the validation error message --}}
                    {{ $message }}
                </div>
            {{-- END ERROR CHECK --}}
            @enderror
        </div>

        <div class="row">
            <!-- Password -->
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label text-converge-primary fw-medium">
                    Password
                </label>
                {{-- PASSWORD INPUT - Hidden text field for creating password --}}
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required autocomplete="new-password"
                       placeholder="Create a password">
                {{-- PASSWORD ERROR CHECK - Show error message if password validation fails --}}
                @error('password')
                    <div class="invalid-feedback">
                        {{-- ERROR OUTPUT - Display the validation error message --}}
                        {{ $message }}
                    </div>
                {{-- END ERROR CHECK --}}
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label text-converge-primary fw-medium">
                    Confirm Password
                </label>
                {{-- CONFIRM PASSWORD INPUT - Hidden text field for confirming password --}}
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       required autocomplete="new-password"
                       placeholder="Confirm your password">
                {{-- CONFIRM PASSWORD ERROR CHECK - Show error message if confirmation validation fails --}}
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{-- ERROR OUTPUT - Display the validation error message --}}
                        {{ $message }}
                    </div>
                {{-- END ERROR CHECK --}}
                @enderror
            </div>
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary fw-medium"
                    style="background-color: var(--converge-accent-green); border-color: var(--converge-accent-green);">
                <i class="ion-person-add me-2"></i>Create Account
            </button>
        </div>

        <div class="text-center mt-2">
            <span class="text-muted small">Already have an account? </span>
            {{-- LOGIN LINK - Navigate to login page for existing users --}}
            <a href="{{ route('login') }}" class="text-decoration-none fw-medium"
               style="color: var(--converge-accent-blue);">
                Sign in here
            </a>
        </div>
    </form>
{{-- END LAYOUT --}}
</x-guest-layout>
