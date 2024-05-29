<?php

use App\Models\User;

it('can get purchase', function () {
//    $this
//        ->postJson(route('login'), [
//            'email' => "filipplass@gmail.com",
//            'password' => 'Password1',
//        ]);
    $user = User::query()->first();
    $this->actingAs($user)->get(route('purchase'))->assertOk();
});
