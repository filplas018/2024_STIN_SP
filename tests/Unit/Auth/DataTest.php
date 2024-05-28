<?php

use Illuminate\Testing\TestResponse;

it('can get historic data', function () {
    /**
     * @var $response TestResponse
     */
    $response = $this->get(route("data", [
        'city' => "Prague"
    ]));

    //dd($response, $response->getOriginalContent());


    $history = ($response->getOriginalContent()->getData()['page']['props']['history']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($history);
    $this->assertNotNull($favourite);
});
