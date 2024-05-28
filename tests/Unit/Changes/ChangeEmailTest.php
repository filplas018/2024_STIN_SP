<?php

use App\Models\User;

it('can change email', function () {


    $user = User::create([
        'email'=>"test1212345@ex.cz",
        'password'=>"Password",
    ]);
    $this->postJson(route("login"),
        [
            'email' => "test1212345@ex.cz",
            'password' => "Password",
        ])->assertRedirect(route(("home")));

    $response = $this->postJson(route("change-email"),
        [
            'current_password' => "Password",
            'new_email' => 'testovaci420@test.com'
        ])->assertFound();
    $res=User::query()->where('id',$user->getKey())->delete();
});
