<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile - Converge</title>

    <!-- External CSS libraries for styling and icons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    {{-- BOOTSTRAP CSS - Load Bootstrap stylesheet from assets --}}
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-converge-primary">
    {{-- NAVIGATION COMPONENT - Include navbar with user authentication --}}
    <x-navbar></x-navbar>

    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Page Header -->
                <div class="bg-white rounded-3 converge-shadow p-4 mb-4 border border-converge-light">
                    <h1 class="h3 text-converge-primary fw-light mb-2">
                        <i class="ion-person me-2 text-converge-accent-blue"></i>Profile Settings
                    </h1>
                    <p class="text-muted mb-0">Manage your account information and preferences</p>
                </div>

                <!-- Profile Information Form -->
                <div class="bg-white rounded-3 converge-shadow p-4 mb-4 border border-converge-light">
                    <div class="border-bottom border-converge-light pb-3 mb-4">
                        <h4 class="h5 text-converge-primary fw-medium mb-2">
                            <i class="ion-edit me-2 text-converge-accent-orange"></i>Profile Information
                        </h4>
                        <p class="text-muted small mb-0">Update your account's profile information and email address.</p>
                    </div>

                    {{-- SUCCESS MESSAGE - Show success alert when profile is updated --}}
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success mb-4" >
                            <i class="ion-checkmark-circled me-2"></i>Profile updated successfully!
                        </div>
                    {{-- END SUCCESS CHECK --}}
                    @endif

                    {{-- PROFILE UPDATE FORM - Form to update user profile information --}}
                    <form method="POST" action="{{ route('profile.update') }}">
                        {{-- CSRF TOKEN - Security token for form submission --}}
                        @csrf
                        {{-- HTTP METHOD - Override to PATCH for update operation --}}
                        @method('patch')

                        <div class="row">
                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label text-converge-primary fw-medium">
                                    <i class="ion-at me-1"></i>Username
                                </label>
                                {{-- USERNAME INPUT - Text field with current username value --}}
                                <input id="username" type="text" name="username"
                                       class="form-control @error('username') is-invalid @enderror"
                                       value="{{ old('username', $user->username) }}"
                                       required autocomplete="username">
                                {{-- USERNAME ERROR - Show validation error if username is invalid --}}
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                {{-- END ERROR CHECK --}}
                                @enderror
                            </div>

                            <!-- Display Name -->
                            <div class="col-md-6 mb-3">
                                <label for="display_name" class="form-label text-converge-primary fw-medium">
                                    <i class="ion-person me-1"></i>Display Name
                                </label>
                                {{-- DISPLAY NAME INPUT - Text field with current display name value --}}
                                <input id="display_name" type="text" name="display_name"
                                       class="form-control @error('display_name') is-invalid @enderror"
                                       value="{{ old('display_name', $user->display_name) }}"
                                       required>
                                {{-- DISPLAY NAME ERROR - Show validation error if display name is invalid --}}
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                {{-- END ERROR CHECK --}}
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-converge-primary fw-medium">
                                <i class="ion-email me-1"></i>Email Address
                            </label>
                            {{-- EMAIL INPUT - Email field with current email value --}}
                            <input id="email" type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}"
                                   required autocomplete="email">
                            {{-- EMAIL ERROR - Show validation error if email is invalid --}}
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            {{-- END ERROR CHECK --}}
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <label for="bio" class="form-label text-converge-primary fw-medium">
                                <i class="ion-document-text me-1"></i>Bio
                                <span class="text-muted small">(Optional)</span>
                            </label>
                            {{-- BIO TEXTAREA - Multi-line text field for user biography --}}
                            <textarea id="bio" name="bio" rows="3"
                                      class="form-control @error('bio') is-invalid @enderror"
                                      placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                            {{-- BIO ERROR - Show validation error if bio is invalid --}}
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            {{-- END ERROR CHECK --}}
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary fw-medium"
                                    style="background-color: var(--converge-accent-blue); border-color: var(--converge-accent-blue);">
                                <i class="ion-checkmark me-2"></i>Save Changes
                            </button>
                            <a href="/" class="btn btn-outline-secondary">
                                <i class="ion-arrow-left-c me-2"></i>Back to Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- BOOTSTRAP JS - Load Bootstrap JavaScript bundle from assets --}}
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
