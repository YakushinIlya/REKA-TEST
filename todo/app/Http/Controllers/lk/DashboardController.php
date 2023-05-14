<?php

namespace App\Http\Controllers\lk;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $title = 'Dashboard';

        return view('dashboard.home', compact('title'));
    }
}
