<?php
// PROFILE CONTROLLER - Handles user profile operations

namespace App\Http\Controllers;

// Import custom form request for profile validation
use App\Http\Requests\ProfileUpdateRequest;
// Import redirect response type
use Illuminate\Http\RedirectResponse;
// Import basic request class
use Illuminate\Http\Request;
// Import authentication helper
use Illuminate\Support\Facades\Auth;
// Import redirect helper
use Illuminate\Support\Facades\Redirect;
// Import view response type
use Illuminate\View\View;

// PROFILE CONTROLLER CLASS - Manages user profile CRUD operations
class ProfileController extends Controller
{
    // EDIT METHOD - Shows profile edit form
    public function edit(Request $request): View
    {
        // RETURN VIEW - Send profile.edit.blade.php with current user data
        return view('profile.edit', [
            // GET CURRENT USER - Pass authenticated user object to view
            'user' => $request->user(),
        ]);
    }

    // UPDATE METHOD - Processes profile update form submission
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // FILL USER DATA - Update user model with validated form data
        $request->user()->fill($request->validated());

        // CHECK EMAIL CHANGE - If email was modified
        if ($request->user()->isDirty('email')) {
            // RESET EMAIL VERIFICATION - Clear verification timestamp
            $request->user()->email_verified_at = null;
        }

        // SAVE TO DATABASE - Persist changes to users table
        $request->user()->save();

        // REDIRECT WITH SUCCESS - Go back to edit form with success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // DESTROY METHOD - Deletes user account permanently
    public function destroy(Request $request): RedirectResponse
    {
        // VALIDATE PASSWORD - Check current password before deletion
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // GET USER OBJECT - Store reference to current user
        $user = $request->user();

        // LOGOUT USER - End current session
        Auth::logout();

        // DELETE USER - Remove user record from database
        $user->delete();

        // INVALIDATE SESSION - Destroy session data
        $request->session()->invalidate();
        // REGENERATE TOKEN - Create new CSRF token
        $request->session()->regenerateToken();

        // REDIRECT HOME - Send user to homepage
        return Redirect::to('/');
    }
}
