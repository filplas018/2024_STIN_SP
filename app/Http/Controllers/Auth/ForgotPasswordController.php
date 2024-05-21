<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return Inertia::render('Forms/ForgotPassword');
    }

    public function forgotPasswordLink(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
        ]);

        $email = $request->only('email');
        $user = $user
            ->where('email', $request->only('email'))
            ->first();

        if (is_null($user)) {
            return back()->withErrors([
                '' => 'Provided email is not in our records!',
            ]);
        }

        $token = Str::random(64);
        $name = $user
            ->where('email', $email)
            ->first()
            ->name;
        $id = $user
            ->where('email', $email)
            ->first()
            ->id;

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('mail', ['token' => $token, 'id' => $id, 'name' => $name], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        //return back()->with('message', 'We have e-mailed your password reset link!');
        return Inertia::render('Forms/ForgotPassword', [
            'isSuccess' => true,
            'message' => 'Check your e-mail, we have sent an email for password reset link!',
        ]);
    }
}

