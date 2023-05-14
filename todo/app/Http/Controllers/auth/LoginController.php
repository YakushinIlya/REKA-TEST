<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest)
    {
        $data = $loginRequest->validated();

        if (Auth::attempt($loginRequest->only('email', 'password'))) {
            return redirect()->route('lk.dashboard');
        }

        return redirect('/');
    }
}
