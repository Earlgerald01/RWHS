<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseAuth;

class AuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $token = $this->firebaseAuth->login($email, $password);

        if ($token) {
            session(['firebase_token' => $token]);
            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors(['login_failed' => 'Invalid credentials']);
        }
    }
}

