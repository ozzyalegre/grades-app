<?php

use App\Http\Controllers\DashboardDataController;
use Illuminate\Support\Carbon;
use App\Http\Controllers\EmailController;
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

// Route::get('/getmail', [EmailController::class, ('get_mail')]);
Route::get('/getmail', function () {
    // Get Latest Message
    $today = Carbon::today();
    $message = (new MailService)->GetMail($today);
    
    // Parse New Message
    $parser = new ParseService;
    $parsed_class_grades = $parser->ParseHtml($message->body);
    $parsed_terms = $parser->GetTerm();

    // DataStorage Time!
    $ds = new DataStorageService;
    $ds->CreateTerms($parsed_terms);    // Create Terms if they do not exist
    $report = $ds->CreateReport($message);    // Create New Report entry
    $ds->CreateSubjectsAndGrades($parsed_class_grades, $report); // Adds grades to grades table & subjects if they do not exist
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardDataController::class, 'show'])->name('dashboard');
});
