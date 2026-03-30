<?php

use Illuminate\Support\Facades\Route;
use Modules\Campaigns\Http\Controllers\CampaignsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('campaigns', CampaignsController::class)->names('campaigns');
});
