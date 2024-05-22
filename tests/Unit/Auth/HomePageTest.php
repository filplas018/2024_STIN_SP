<?php

it('can get home page', function () {
    $response = $this->get(route("home", [
        'city' => "Prague"
    ]));
    $weather = ($response->getOriginalContent()->getData()['page']['props']['weather']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($weather);
    $this->assertNotNull($favourite);
});
