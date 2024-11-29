<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory; // Import the Firebase Factory if you’re using Firebase

class FirebaseController extends Controller
{
    public function index()
    {
        // Fetch data if necessary and pass it to the view
        return view('waterlevel'); // Make sure there is a 'waterlevel.blade.php' in the 'resources/views' directory
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function history()
    {
        return view('history');
    }

    public function getWaterLevelData()
    {
        // Your code for retrieving data from Firebase
    }
}
