<?php

use Illuminate\Support\Facades\Auth;

it('can logout', function () {
    $this->get(route('logout'))->assertRedirect('login');

    $this->assertTrue(is_null(Auth::user()));
});
