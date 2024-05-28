<?php

namespace App\Http\Controllers;

use App\Dtos\FavouriteLocationDto;
use App\Dtos\LocalWeatherDto;
use App\Dtos\WeatherHistoryDto;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class DataController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Responsable|\Symfony\Component\HttpFoundation\Response
    {
        $validator = Validator::make($request->all(), [
            'city' => ["sometimes", "string"],
            'start_date' => ['sometimes'],
            'end_date' => ['sometimes'],
        ]);

        if ($validator->fails()) {
            return Inertia::render('Data', [
                'error' => 'Neplatné město!',
                'city' => $request->input('city'),
            ]);
        }

        $data = $validator->validate();
        $city = $data['city']??"Praha";
        $apiKey = Env::get("OPENWEATHER_API_KEY");
        $startDate = $data['start_date'] ?? Carbon::now()->subWeek();
        $endDate = $data['end_date'] ?? Carbon::now();

        $startDate = \Illuminate\Support\Carbon::createFromDate($startDate)->unix();
        $endDate = \Illuminate\Support\Carbon::createFromDate($endDate)->unix();


        $cityUrl = "https://api.openweathermap.org/data/2.5/weather?&lang=en&units=metric&q={$city}&appid={$apiKey}";
        $responseCity = Http::get($cityUrl);

        $histories = null;
        if ($responseCity->ok()) {
            $cityDataNow = LocalWeatherDto::from($responseCity->json());

            $apiUrl = "https://history.openweathermap.org/data/2.5/history/city?lat={$cityDataNow->lat}&lon={$cityDataNow->lon}&type=hour&start={$startDate}&end={$endDate}&units=metric&appid={$apiKey}";
            $response = Http::get($apiUrl);
            if ($response->ok()) {
                $list = $response->json('list');

                $histories = WeatherHistoryDto::collect($list, Collection::class);

            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

        $user = $request->user();

        $locations = FavouriteLocationDto::collect(
            Location::query()
                ->where('user_id', $user->getKey())
                ->get()
        );

        return Inertia::render('Data', [
            'history' => $histories?->toArray(),
            'city' => $cityDataNow->name,
            'favourite' => $locations?->toArray()
        ]);
    }
}
