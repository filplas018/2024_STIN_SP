<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


final class ChangePasswordController extends Controller
{
    /**
     * Changes users password
     * @param Request $request has current password and new password
     * @return Response
     */
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
            'new_password' => [
                'required',
                'confirmed',
                'min:3',
            ],
        ]);

        $user->forceFill([
            'password' => Hash::make($data['new_password'])
        ])->setRememberToken(Str::random(60));

        $user->save();

        return Redirect::back()
            ->with([
                'flash' => 'Akce úspěšna!',
            ]);
    }
}
