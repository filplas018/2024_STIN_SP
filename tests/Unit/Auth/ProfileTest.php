<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\{actingAs};


it('can get profile', function () {
    $this->get(route('logout'))->assertRedirect('login');
    $user = User::query()->first();

    $this
        ->actingAs($user)
        ->get(route('profile'))->assertOk();

});
