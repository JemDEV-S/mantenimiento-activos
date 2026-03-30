<?php

use Illuminate\Support\Facades\Route;
use Modules\Assignments\Http\Controllers\AssignmentsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('assignments', AssignmentsController::class)->names('assignments');
});
