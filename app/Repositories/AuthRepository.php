<?php

namespace App\Repositories;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Interface\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function login(array $data)
    {
        $remember = $data['remember'] ?? false;

        if (\Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ], $remember)) {
            session()->regenerate();

            return true;
        };

        return false;
    }

    public function logout($request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return true;
    }
}
