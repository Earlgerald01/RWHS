<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
{
    return view('dashboard');
}

public function waterlevel()
{
    return view('waterlevel');
}

public function history()
{
    return view('history');
}

}
