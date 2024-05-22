<?php

it('can get purchase', function () {
    $this->get(route('purchase'))->assertOk();
});
