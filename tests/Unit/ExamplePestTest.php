<?php

use App\Models\User;

it('expect', function () {
    expect(true)->toBeTrue();
});

it('can access login', function () {


        $this->get(route("login"))->assertOk();


});

it('can access register', function () {
    $this->get(route('logout'))->assertOk('login');



        $this->get(route("register"))->assertOk();
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
//\Illuminate\Support\Facades\File::get(storage_path("logs/laravel.log"))

it('can submit login', function () {
    $this->postJson(route("login"),
        [
            'email' => "testik@test.com",
            'password' => "Password4",
        ])->assertRedirect(route(("home")));
});


