<?php

it('can get profile', function () {
    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);
    /**
     * @var $response TestResponse
     */
    $this->get(route('profile'))->assertOk();
});
