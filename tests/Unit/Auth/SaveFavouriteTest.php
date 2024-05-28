<?php

it('can post favourites', function () {
    $this->post(route("home", [
        'city' => "Prague",
        'long' => 15.21,
        'lat' => 14.14
    ]))->assertRedirect(route('home'));
});

