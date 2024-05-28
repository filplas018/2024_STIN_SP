<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

/**
 * Controller for profile page
 */
class ProfileController extends Controller
{
    /**
     * Renders profile page
     * @return \Inertia\Response
     */
    public function __invoke()
    {
        return Inertia::render('Profile', []);
    }
}
