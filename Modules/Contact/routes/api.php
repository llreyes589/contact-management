<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;

Route::prefix('v1')->group(function () {
    Route::apiResource('contacts', ContactController::class)->names('contact');
});
