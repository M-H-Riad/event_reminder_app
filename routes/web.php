<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group(function () { //We also can add 'role:super-admin' | 'permission:manage-event' for making it specific
    Route::resource('events', EventController::class);
});

Route::get('/events/demo-csv', [EventController::class, 'downloadDemoCsv'])->name('events.demo-csv');
Route::post('/events/import-csv', [EventController::class, 'importCsv'])->name('events.import-csv');
Route::get('events/send-reminder/{id}', [EventController::class, 'sendReminder'])->name('events.send-reminder');

require __DIR__.'/auth.php';
