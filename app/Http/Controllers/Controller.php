<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

abstract class Controller {
    public function __construct()
    {
        Inertia::share("user", Auth::user()?->toArray());
        Inertia::share("flash", Session::get('flash'));
    }
}
