<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('can logout', function () {

    $user = User::query()->first();
    $this->actingAs($user)->get(route('logout'))->assertRedirect('login');


    $this->assertTrue(is_null(Auth::user()));
});
