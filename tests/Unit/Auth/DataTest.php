<?php

it('can get historic data', function () {

    $response = $this->get(route("data", [
        'city' => "Prague"
    ]));

    $history = ($response->getOriginalContent()->getData()['page']['props']['history']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($history);
    $this->assertNotNull($favourite);
});
