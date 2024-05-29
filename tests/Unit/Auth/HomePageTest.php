<?php

use App\Models\User;

it('can get home page', function () {

    $user = User::query()->first();
    $response = $this->actingAs($user)->get(route("home", [
        'city' => "Prague"
    ]));

    $weather = ($response->getOriginalContent()->getData()['page']['props']['weather']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($weather);
    $this->assertNotNull($favourite);
});
