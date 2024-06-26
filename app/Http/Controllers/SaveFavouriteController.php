<?php

namespace App\Http\Controllers;


use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for saving favourite location
 */
class SaveFavouriteController extends Controller
{


    /**
     * Saves favourite location by given city, long and lat for current user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'city' => ['required'],
            'long' => ['required'],
            'lat' => ['required'],
        ]);

        $user = $request->user();

        Location::query()->updateOrCreate([
            'user_id' => $user->getKey(),
            'name' => $data['city'],
        ], [
            'long' => $data['long'],
            'lat' => $data['lat'],
        ]);

        return Redirect::back()
            ->with([
                'flash' => 'Uloženo do oblíbených!',
            ]);
    }
}
