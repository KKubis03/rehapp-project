<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/login', [HomeController::class, "login"])->name('login');
Route::post('/login/authenticate', [HomeController::class, "authenticate"]);
Route::get('/register', [HomeController::class, "register"]);
Route::post('/register/create', [HomeController::class, "addToDB"]);
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/services', [ServicesController::class, 'index']);
});
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});