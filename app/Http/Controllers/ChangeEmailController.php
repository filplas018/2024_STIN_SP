<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final class ChangeEmailController extends Controller
{
    public function __invoke(Request $request): Response
    {
        /**
         * @var $user User
         */
        $user = $request->user();
        $password = $user->getAuthPassword();

        $data = $request->validate([
            'current_password' => [
                'required',
                static fn(string $attribute, mixed $value, \Closure $fail) => Hash::check($value, $password)
                    ?: $fail("{$attribute} neni správné současní heslo!"),
            ],
            'new_email' => [
                'required',
            ],
        ]);

        $user->forceFill([
            'email' => $data['new_email']
        ])->setRememberToken(Str::random(60));

        $user->save();

        return Redirect::back()
            ->with([
                'flash' => 'Email změněn!',
            ]);
    }
}

