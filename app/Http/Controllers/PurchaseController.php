<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


/**
 * Controller for purchase page
 */
class PurchaseController extends Controller
{

    /**
     * Renders purchase page
     * @param Request $request
     * @return Responsable
     */
    public function __invoke(Request $request) : Responsable
    {
        return Inertia::render('Purchase', []);
    }
}
