<?php

use App\Models\User;

it('expect', function () {
    expect(true)->toBeTrue();
});

it('can access login', function () {
    $this->get(route("login"))->assertOk();
});

it('can access register', function () {
    $this->get(route("register"))->assertOk();
});

it('can submit register', function () {
    $email = "example20@test.com";
    $response = $this->postJson(route("register"),
    [
        'email' => $email,
        'password' => "Password1",
        'confirmPassword' => "Password1"
    ])->assertRedirect(route(("login")));

    $user = User::query()->get()->where('email', $email);
    $this->assertTrue($user !== null);
});

it('can submit login', function () {

    $user = User::query()->create([
       'email' => "example72@test.com",
        'password' => "Password1"

    ]);

    $response = $this->postJson(route("login"),
        [
            'email' => $user->email,
            'password' => "Password1",
        ])->assertRedirect(route(("home")));
});


