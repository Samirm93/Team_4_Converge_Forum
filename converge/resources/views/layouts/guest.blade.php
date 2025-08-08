
{{-- GUEST LAYOUT - Layout template for non-authenticated pages --}}
<!DOCTYPE html>
{{-- HTML LANG - Set language from Laravel app locale --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- CSRF TOKEN - Meta tag for CSRF protection --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>User Action</title>

        <!-- External CSS libraries for styling and icons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
        {{-- BOOTSTRAP CSS - Load Bootstrap stylesheet from assets --}}
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
        {{-- CUSTOM CSS - Load custom application styles --}}
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </head>
    <body class="bg-converge-primary">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
            <div class="mb-4">
                {{-- HOME LINK - Logo and brand name link back to homepage --}}
                <a href="/" class="text-decoration-none">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <img src="/images/converge_logo.png" style="width: 60px; height: 60px; object-fit: contain; transition: transform 0.3s ease;">
                    </div>
                    <h2 class="text-center text-converge-primary mb-2 fw-light">Converge</h2>
                </a>
                <span class="text-muted display-6 fs-5">Where Ideas Meet</span>
            </div>

            <div class="w-100" style="max-width: 500px;">
                <div class="bg-white rounded-3 converge-shadow p-4 border border-converge-light">
                    {{-- SLOT CONTENT - Display the main content passed to this layout --}}
                    {{ $slot }}
                </div>
            </div>
        </div>

        {{-- BOOTSTRAP JS - Load Bootstrap JavaScript bundle from assets --}}
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
