<?php

it('can get profile', function () {
    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);

    $this->get('/profile')->assertFound();
});
