<?php

use App\Http\Controllers\EmailController;
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
    $message = (new MailService)->GetMail("10/27/2023");
    
    // Parse New Message
    $parser = new ParseService;
    $parsed_class_grades = $parser->ParseHtml($message->body);
    $parsed_terms = $parser->GetTerm();

    // Store New Classes 
    



    dd(
        $parsed_terms, $parsed_class_grades);

    // return($message->body);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
