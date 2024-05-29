<?php

use App\Models\User;
use Illuminate\Testing\TestResponse;

it('can get historic data', function () {

    $user = User::query()->first();
    $response = $this->actingAs($user)->get(route("data", [
        'city' => "Prague"
    ]));

    dd($response, $response->getOriginalContent());


    $history = ($response->getOriginalContent()->getData()['page']['props']['history']);
    $favourite = ($response->getOriginalContent()->getData()['page']['props']['favourite']);
    $this->assertNotEmpty($history);
    $this->assertNotNull($favourite);
});
