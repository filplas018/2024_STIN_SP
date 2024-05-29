<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('can submit purchase', function () {
    $user = User::query()->first();

    $this->actingAs($user)->postJson(route("purchase.submit"),
        [
            'months' => 5,
            'card_number' => "4701322211111234",
            'card_holder' => "Radek",
            'expiration_date_month' => "12",
            'expiration_date_year' => "26",
            'cvv' => "837"
        ])->assertRedirect(route('home'));

    $user = Auth::user();
    $usub = $user->currentSubscription();
    $this->assertTrue($usub !== null);
});

/*
 *
 * <p>number: 4701322211111234</p>
        <p>due: 12/26</p>
        <p>ccv: 837</p>*/
