<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\{actingAs};


it('can get profile', function () {
    $user = User::query()->first();
    $this
        ->actingAs($user)
        ->get(route('profile'))->assertOk();

});
