<?php

it('can get purchase', function () {
    $this
        ->postJson(route('login'), [
            'email' => "testik@test.com",
            'password' => 'Password4',
        ]);
    $this->get(route('purchase'))->assertOk();
});
