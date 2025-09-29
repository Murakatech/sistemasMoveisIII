<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthServices
{
    public function login(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

}
