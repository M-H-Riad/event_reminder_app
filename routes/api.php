<?php

use App\Http\Controllers\API\EventController;
use Illuminate\Support\Facades\Route;


Route::post('api/events', [EventController::class, 'store']);


