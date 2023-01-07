<?php

use CourseLink\Payments\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::any('{gateway}/webhook', [NotificationController::class, 'handleNotification'])->name('webhook');