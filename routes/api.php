<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\CabinImageController;
use App\Http\Controllers\UserImageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewAlertController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReservationHistoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\AccessLogController;
use App\http\Controllers\AvailabilityController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('cabins', CabinController::class);
    Route::apiResource('cabin-images', CabinImageController::class);
    Route::apiResource('user-images', UserImageController::class);
    Route::apiResource('calendars', CalendarController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('refunds', RefundController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('review-alerts', ReviewAlertController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('reservation-histories', ReservationHistoryController::class);
    Route::apiResource('chats', ChatController::class);
    Route::apiResource('chat-messages', ChatMessageController::class);
    Route::apiResource('access-logs', AccessLogController::class);
    Route::apiResource('availabilities', AvailabilityController::class);

});
