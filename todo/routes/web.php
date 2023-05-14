<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'login'])->name("home");

Route::get('/clear-cache', function() {
    $configCache = Artisan::call('config:cache');
    $clearCache  = Artisan::call('cache:clear');
    $clearView   = Artisan::call('view:clear');
    echo "КЕШ был почищен успешно, мой господин!";
});

Route::get("register", [\App\Http\Controllers\auth\RegisterController::class, "getRegisterForm"])->name("form.register");
Route::post("register", [\App\Http\Controllers\auth\RegisterController::class, "setRegisterUser"])->name("register");
Route::post("login", \App\Http\Controllers\auth\LoginController::class)->name("login");

Route::prefix("lk")->middleware(["auth"])->name("lk.")->group(function(){
    Route::get("dashboard", \App\Http\Controllers\lk\DashboardController::class)->name("dashboard");
    Route::get("my-lists", \App\Http\Controllers\lk\my\ListsController::class)->name("my-lists");
    Route::get("trust-lists", \App\Http\Controllers\lk\trust\ListsController::class)->name("trust-lists");

    Route::get("add", \App\Http\Controllers\lk\my\AddController::class)->name("add");
    Route::post("create", \App\Http\Controllers\lk\my\CreateController::class)->name("create");
    Route::get("edit/{id}", \App\Http\Controllers\lk\my\EditController::class)->name("edit");
    Route::post("update/{id}", \App\Http\Controllers\lk\my\UpdateController::class)->name("update");
    Route::post("update/permission/{id}", \App\Http\Controllers\lk\my\UpdatePermissionController::class)->name("update.permission");
    Route::post("delete/{id}", \App\Http\Controllers\lk\my\DeleteController::class)->name("delete");

    Route::get("tag/{id}", \App\Http\Controllers\lk\TagController::class)->name("tag");
    Route::post("search/{search}", \App\Http\Controllers\lk\SearchController::class)->name("search");

    Route::get("logout", function(){
        Auth::logout();
        return redirect('/');
    })->name("logout");
});


