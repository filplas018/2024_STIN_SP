<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProfileController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Profile', []);
    }
}
