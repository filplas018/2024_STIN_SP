<?php

use Illuminate\Testing\TestResponse;

it('can get historic data', function () {
    /**
     * @var $response TestResponse
     */
    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);
    $response = $this->get(route("data", [
        'city' => "Prague"
    ]));

    //dd($response, $response->getOriginalContent());


    $history = ($response->getOriginalContent()->getData()['page']['props']['history']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($history);
    $this->assertNotNull($favourite);
});
