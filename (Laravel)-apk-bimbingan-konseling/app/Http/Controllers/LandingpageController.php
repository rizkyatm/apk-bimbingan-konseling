<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function landing()
    {
        return view('landingpage');
    }
}
