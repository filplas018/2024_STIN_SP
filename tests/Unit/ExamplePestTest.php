<?php

use App\Models\User;

it('expect', function () {
    expect(true)->toBeTrue();
});

it('can access login', function () {

    try {
        $this->get("/login")->assertFound();
    } catch (\Exception $e) {
        dd($e);
    }

});

it('can access register', function () {
    $this->get(route('logout'))->assertRedirect('login');

    $this->get("/register")->assertOk();
});

it('can submit register', function () {
    $email = "example42069@test.com";
    $response = $this->postJson(route("register"),
    [
        'email' => $email,
        'password' => "Password1",
        'confirmPassword' => "Password1"
    ])->assertRedirect(route(("login")));

    $user = User::query()->get()->where('email', $email);
    $this->assertTrue($user !== null);
    User::query()->where('email',$email)->delete();
});

it('can submit login', function () {
    $this->postJson(route("login"),
        [
            'email' => "testik@test.com",
            'password' => "Password4",
        ])->assertRedirect(route(("home")));
});


