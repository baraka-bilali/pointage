<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');  

    // agents
    Route::resource('agents', AgentController::class)->except(['edit', 'show']);
    Route::get('/agents/{agent}', [AgentController::class, 'show'])->name('agents.show');
    // End agents

    // Route pour afficher la page de scan QR
    Route::get('/scan-qr', [AttendanceController::class, 'showScanPage'])->name('scan-qr');

    // Route pour traiter le formulaire après le scan QR
    Route::post('/scan-qr', [AttendanceController::class, 'scanQr'])->name('scan-qr.submit');
    
    // Routes d'authentification API avec Laravel Sanctum
    Route::post('/api/register', [AuthController::class, 'register']);
    Route::post('/api/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/api/logout', [AuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->get('/api/user', [AuthController::class, 'user']);

});

Route::get('/', function () {
    return view('auth.login');
});
