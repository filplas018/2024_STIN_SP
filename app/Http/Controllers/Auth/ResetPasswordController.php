<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Inertia\Inertia;

class ResetPasswordController extends Controller
{
    public function resetPasswordIndex($id, $token)
    {
        return Inertia::render('Forms/ResetPassword', ['id' => $id, 'token' => $token]);
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => ['required', PasswordRule::min(8)
                ->mixedCase()
                ->numbers(),
            ],
            'password_confirmation' => 'required|same:password',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $request->token,
            ])
            ->first();

        if (! $updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('id', $request->id);
        $user
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['token' => $request->token])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');

        /*

        $status = Password::reset(
            $request->only('password', 'password_confirmation'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        */

        /*return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);*/
    }
}
