<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\Inertia;

class HomePageController
{
    public function __invoke()
    {
        return Inertia::render('HomePage', [
            //'title' => 'Doma pico',

        ]);
    }
}
