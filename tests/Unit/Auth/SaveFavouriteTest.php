<?php

it('can post favourites', function () {
    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);
    $this->post(route("home", [
        'city' => "Prague",
        'long' => 15.21,
        'lat' => 14.14
    ]))->assertRedirect(route('home'));
});

