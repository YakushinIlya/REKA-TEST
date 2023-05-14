<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function login()
    {
        $title = "Форма входа";

        return view("auth.login", compact("title"));
    }
}
