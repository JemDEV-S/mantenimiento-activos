<?php

use Illuminate\Support\Facades\Route;
use Modules\Assignments\Http\Controllers\AssignmentsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('assignments', AssignmentsController::class)->names('assignments');
});
