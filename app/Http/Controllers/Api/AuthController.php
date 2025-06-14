<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Repositories\AuthRepository;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponse;

    public function __construct(protected AuthRepository $authRepository){}
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        try {
            $success = $this->authRepository->login($data);

            if (!$success) {
                return $this->fail('Invalid credentials', '', 'Unauthorized', 401);
            }

            return $this->success(
                'Success',
                ['user' => auth()->user()],
                'Login Success',
                200
            );
        } catch (\Throwable $th) {
            return $this->fail('failed to login', $th->getMessage(), 'Failed to login', 500);
        }
    }

    public function logout(LogoutRequest $request)
    {
        try {
            $this->authRepository->logout($request);

            return $this->success(
                'Success',
                [],
                'Logout Success',
                200
            );
        } catch (\Throwable $th) {
            return $this->fail('failed to logout', $th->getMessage(), 'Failed to logout', 500);
        }
    }
}
