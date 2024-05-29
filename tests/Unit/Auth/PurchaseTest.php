<?php

it('can get purchase', function () {
//    $this
//        ->postJson(route('login'), [
//            'email' => "filipplass@gmail.com",
//            'password' => 'Password1',
//        ]);
    $this->get('/purchase')->assertFound();
});
