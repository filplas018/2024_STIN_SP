<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


class PurchaseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : Responsable
    {
        return Inertia::render('Purchase', []);
    }
}
