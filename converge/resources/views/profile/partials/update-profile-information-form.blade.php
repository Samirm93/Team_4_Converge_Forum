{{-- PROFILE INFORMATION SECTION - Form section for updating user profile --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{-- SECTION TITLE - Translated heading for profile information --}}
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{-- SECTION DESCRIPTION - Translated description of what this form does --}}
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- EMAIL VERIFICATION FORM - Hidden form for resending verification email --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        {{-- CSRF TOKEN - Security token for verification request --}}
        @csrf
    </form>

    {{-- PROFILE UPDATE FORM - Main form for updating profile information --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        {{-- CSRF TOKEN - Security token for form submission --}}
        @csrf
        {{-- HTTP METHOD - Override to PATCH for update operation --}}
        @method('patch')

        <div>
            {{-- NAME LABEL COMPONENT - Label for name input field --}}
            <x-input-label for="name" :value="__('Name')" />
            {{-- NAME INPUT COMPONENT - Text input with current name value --}}
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            {{-- NAME ERROR COMPONENT - Show validation errors for name field --}}
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            {{-- EMAIL LABEL COMPONENT - Label for email input field --}}
            <x-input-label for="email" :value="__('Email')" />
            {{-- EMAIL INPUT COMPONENT - Email input with current email value --}}
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            {{-- EMAIL ERROR COMPONENT - Show validation errors for email field --}}
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- EMAIL VERIFICATION CHECK - Show verification prompt if email is unverified --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{-- UNVERIFIED MESSAGE - Tell user their email is unverified --}}
                        {{ __('Your email address is unverified.') }}

                        {{-- RESEND VERIFICATION BUTTON - Button to resend verification email --}}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    {{-- VERIFICATION SENT MESSAGE - Show success message when verification email sent --}}
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    {{-- END VERIFICATION SENT CHECK --}}
                    @endif
                </div>
            {{-- END VERIFICATION CHECK --}}
            @endif
        </div>

        <div class="flex items-center gap-4">
            {{-- SAVE BUTTON COMPONENT - Primary button to submit form --}}
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            {{-- SUCCESS MESSAGE - Show temporary success message when profile updated --}}
            @if (session('status') === 'profile-updated')
                {{-- ALPINE.JS SUCCESS MESSAGE - Auto-hide success message after 2 seconds --}}
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            {{-- END SUCCESS CHECK --}}
            @endif
        </div>
    </form>
</section>
