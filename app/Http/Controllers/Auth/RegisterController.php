<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

/**
 * Controller for registration
 */
class RegisterController extends Controller
{
    /**
     * renders register page
     * @return \Inertia\Response
     */
    public function register()
    {
        return Inertia::render('Register');
    }

    /**
     * Registers user by new credentials
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerPost(Request $request)
    {

        $request->validate([
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->numbers(),
            ],
            'confirmPassword' => 'same:password',
        ]);

        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if (! $user) {
            return back()->withErrors([
                '' => 'Registration failed, try again!',
            ]);
        }

        return redirect(route('login'))->with('success', 'Registration was successful, login now please!');
    }
}

