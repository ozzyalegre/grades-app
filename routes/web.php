<?php

use App\Http\Controllers\DashboardDataController;
use Illuminate\Support\Carbon;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\WebhookController;
use App\Services\DashboardDataService;
use App\Services\DataStorageService;
use Illuminate\Support\Facades\Route;
use App\Services\MailService;
use App\Services\ParseService;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardDataController::class, 'show'])->name('dashboard');
});
