<?php

it('can change password', function () {

  $this->postJson(route("change-password"),
        [
            'current_password' => "Password5",
            'new_password' => "Password6",
            'new_password_confirmation' => "Password6"
        ]);


    $this->postJson(route("login"),
        [
            'email' => 'testik@test.com',
            'password' => "Password6",
        ])->assertRedirect(route('home'));
});
