<?php

it('can get profile', function () {
    $this->get(route('profile'))->assertOk();
});
