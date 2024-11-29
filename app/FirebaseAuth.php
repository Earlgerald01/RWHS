<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseAuth
{
    protected $auth;

    public function __construct()
    {
        $this->auth = (new Factory)
            ->withServiceAccount(config('services.firebase.credentials_file'))
            ->createAuth();
    }

    public function login($email, $password)
    {
        try {
            $user = $this->auth->signInWithEmailAndPassword($email, $password);
            return $user->idToken();
        } catch (\Exception $e) {
            return null;
        }
    }
}
