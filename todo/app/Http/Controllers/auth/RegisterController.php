<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function getRegisterForm()
    {
        $title = "Форма регистрации";

        return view("auth.register", compact("title"));
    }

    public function setRegisterUser(RegisterRequest $registerRequest)
    {
        $data = $registerRequest->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::firstOrCreate([
            "email" => $data["email"],
        ], $data);

        if (Auth::attempt($registerRequest->only('email', 'password'))) {
            return redirect()->route('lk.dashboard');
        }

        return redirect()->route('home');
    }
}
