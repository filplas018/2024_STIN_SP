<?php

it('can get profile', function () {
    $this->get(route('logout'))->assertRedirect('login');

    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);

    try {
        $this
            ->postJson(route('login'), [
                'email' => "testik@test.com",
                'password' => 'Password4',
            ]);

        $this->get('/profile')->assertFound();
    } catch (Exception $e) {
        dd($e);
    }

});
