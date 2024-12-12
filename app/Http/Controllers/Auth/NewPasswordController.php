<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Adjust as per your allowed user types
        ]);

        // Find user based on email and user_type_id
        $user = User::where('email', $request->email)
                    
                    ->first();

                    
        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token', 'user_type'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

            // Check the status of the password reset attempt
            if ($status === Password::PASSWORD_RESET) {
                // Set success message based on user_type_id
                $message = 'Password has been reset successfully';
                // Redirect to the welcome page with success message
                return redirect()->route('login')->with('status', $message);
            } else {
                // Redirect back with error message
                return back()->withInput($request->only('email'))
                             ->withErrors(['email' => __($status)]);
            }
        }
}
