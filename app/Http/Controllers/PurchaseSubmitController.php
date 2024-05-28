<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for payment submission
 */
class PurchaseSubmitController extends Controller
{
    /**
     *  Simulates payment by giving card information and subscribe options
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request) : Response
    {
        $user = $request->user();

        $data = $request->validate([
            'months' => ['required'],
            'card_number' => ['required', new CardNumber()],
            'card_holder' => ['required',],
            'expiration_date_month' => ['required', new CardExpirationMonth($request->string('expiration_date_year'))],
            'expiration_date_year' => ['required', new CardExpirationYear($request->string('expiration_date_month'))],
            'cvv' => ['required', new CardCvc($request->string('card_number'))],
        ]);

        $message = "Již odebíráte náš program!";
        if(!$user->currentSubscription()->exists()){
            $message = 'Děkujeme, právě jste se stali naším opravdovým zákazníkem!';

            $months = $data['months'];
            $valid_until = Carbon::now();
            $valid_until->addMonths($months);
            $payment = Payment::query()
            ->create([
                'price' => $months*20,
                'is_valid' => true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);

            UserSubscription::query()->create([
                'user_id' => $user->getKey(),
                'subscription_id' => Subscription::query()->find(1)->getKey(),
                'payment_id' => $payment->getKey(),
                'valid_from' => Carbon::now(),
                'valid_until' => $valid_until,
            ]);
        }

        return Redirect::route('home')
            ->with([
                'flash' => $message,
            ]);
    }
}
