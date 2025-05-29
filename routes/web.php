<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PhysiotherapistController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/login', [HomeController::class, "login"])->name('login');
Route::post('/login/authenticate', [HomeController::class, "authenticate"]);
Route::get('/register', [HomeController::class, "register"]);
Route::post('/register/create', [HomeController::class, "addToDB"]);
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    // Services Routes
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/services/create', [ServicesController::class, 'create']);
    Route::post('/services/create', [ServicesController::class, "addToDB"]);
    Route::get('/services/edit/{id}', [ServicesController::class, "edit"]);
    Route::post('/services/edit/{id}', [ServicesController::class, "updateToDB"]);
    Route::post('/services/delete/{id}', [ServicesController::class, "delete"]);
    // Physio Routes
    Route::get('/physiotherapists', [PhysiotherapistController::class, 'index']);
    Route::get('/physiotherapists/create', [PhysiotherapistController::class, 'create']);
    Route::post('/physiotherapists/create', [PhysiotherapistController::class, 'addToDB']);
    Route::get('/physiotherapists/details/{id}', [PhysiotherapistController::class, 'details']);
    Route::get('/physiotherapists/edit/{id}', [PhysiotherapistController::class, 'edit']);
    Route::post('/physiotherapists/edit/{id}', [PhysiotherapistController::class, 'updateToDB']);
    Route::post('/physiotherapists/delete/{id}', [PhysiotherapistController::class, 'delete']);
    // Patients Routes
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/create', [PatientController::class, 'create']);
    Route::post('/patients/create', [PatientController::class, 'addToDB']);
    Route::get('/patients/edit/{id}', [PatientController::class, "edit"]);
    Route::post('/patients/edit/{id}', [PatientController::class, "updateToDB"]);
    Route::post('/patients/delete/{id}', [PatientController::class, "delete"]);
});
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});