<?php

namespace App\Interface;

use App\Http\Requests\Auth\LogoutRequest;

interface AuthInterface
{
    public function login(array $data);
    public function logout(LogoutRequest $request);
}
