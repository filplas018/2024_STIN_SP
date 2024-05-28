<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


/**
 *Controller for login
 */
class LoginController extends Controller
{
    /**
     * Renders login page
     * @return \Inertia\Response
     */
    public function login()
    {
        return Inertia::render('Login');
    }

    /**
     * Logs the user in by his credentials
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginPost(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}
