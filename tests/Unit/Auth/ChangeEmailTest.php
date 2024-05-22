<?php

it('can change email', function () {

    $response = $this->postJson(route("change-email"),
        [
            'current_password' => "Password1",
            'new_email' => 'example_new1@test.com'
        ])->assertFound();
});
