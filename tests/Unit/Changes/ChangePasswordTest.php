<?php

use App\Models\User;

it('can change password', function () {

    $user = User::create([
        'email'=>"testovaci121@ex.cz",
        'password'=>"Password",
    ]);
    $this->postJson(route("login"),
        [
            'email' => "testovaci121@ex.cz",
            'password' => "Password",
        ])->assertRedirect(route(("home")));

  $this->postJson(route("change-password"),
        [
            'current_password' => "Password",
            'new_password' => "Password1",
            'new_password_confirmation' => "Password1"
        ]);
    $res=User::query()->where('id',$user->getKey())->delete();

});
