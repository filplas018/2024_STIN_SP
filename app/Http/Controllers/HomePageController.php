<?php

namespace App\Http\Controllers;

use App\Dtos\FavouriteLocationDto;
use App\Dtos\LocalWeatherDto;
use App\Models\Location;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

/**
 * COntroller for home page
 */
class HomePageController extends Controller
{
    /** Renders Home page with weather by given city
     * @param Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $apiKey = Env::get("OPENWEATHER_API_KEY");

        $data = $request->validate([
            'city' => ['sometimes', 'string'],
        ]);


        $city = $data['city'] ?? "prague";

        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?&lang=en&units=metric&q={$city}&appid={$apiKey}";
        $response = Http::get($apiUrl);

        $weatherData = null;
        $user = $request->user();
        if ($response->ok()) {
            $weatherData = LocalWeatherDto::from($response->json());
        }
        $locations = FavouriteLocationDto::collect(
            Location::query()
                ->where('user_id', $user->getKey())
                ->get()
        );

        return Inertia::render('HomePage', [
            'weather'=>$weatherData?->toArray(),
            'favourite' => $locations?->toArray()
        ]);
    }
}
