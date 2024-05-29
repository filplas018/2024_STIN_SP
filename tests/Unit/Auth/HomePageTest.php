<?php

it('can get home page', function () {
    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);
    $response = $this->get(route("home", [
        'city' => "Prague"
    ]));

    $weather = ($response->getOriginalContent()->getData()['page']['props']['weather']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($weather);
    $this->assertNotNull($favourite);
});
