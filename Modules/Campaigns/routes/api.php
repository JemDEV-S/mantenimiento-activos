<?php

use Illuminate\Support\Facades\Route;
use Modules\Campaigns\Http\Controllers\CampaignsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('campaigns', CampaignsController::class)->names('campaigns');
});
