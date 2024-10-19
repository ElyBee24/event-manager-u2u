<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyApiKey;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventController;

Route::middleware(VerifyApiKey::class)->group(function () {
    Route::apiResource('attendees', AttendeeController::class);
    Route::apiResource('events', EventController::class);
    Route::post('events/{event}/add-attendee', [EventController::class, 'addAttendee']);
});