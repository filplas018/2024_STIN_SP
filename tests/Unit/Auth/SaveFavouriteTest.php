<?php

use App\Models\User;

it('can post favourites', function () {
    $user = User::query()->first();
    $this->actingAs($user)->post(route("home", [
        'city' => "Prague",
        'long' => 15.21,
        'lat' => 14.14
    ]))->assertRedirect(route('home'));
});

