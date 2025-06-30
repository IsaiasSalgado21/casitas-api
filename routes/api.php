<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\UserController; 
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
use App\Http\Controllers\AvailabilityController;
use Illuminate\Http\Request;

/**
 * Rutas públicas
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('users', UserController::class);


Route::get('/cabins', [CabinController::class, 'index']);
Route::get('/cabins/{id}', [CabinController::class, 'show']);

Route::get('/cabin-images', [CabinImageController::class, 'index']);
Route::get('/cabin-images/{id}', [CabinImageController::class, 'show']);

Route::get('/availabilities', [AvailabilityController::class, 'index']);
Route::get('/availabilities/{id}', [AvailabilityController::class, 'show']);

Route::apiResource('calendars', CalendarController::class)->parameters([
    'calendars' => 'calendar_id'
]);

Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{review_id}', [ReviewController::class, 'show']);
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('notifications', NotificationController::class)->parameters([
    'notifications' => 'notification_id'
]);

Route::apiResource('reservation-histories', ReservationHistoryController::class);

/**
 * Rutas privadas (requieren autenticación)
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Cabañas: solo editar, crear y eliminar requieren login
    Route::post('/cabins', [CabinController::class, 'store']);
    Route::put('/cabins/{id}', [CabinController::class, 'update']);
    Route::delete('/cabins/{id}', [CabinController::class, 'destroy']);

    // Imágenes de cabaña: crear, actualizar, eliminar
    Route::post('/cabin-images', [CabinImageController::class, 'store']);
    Route::put('/cabin-images/{id}', [CabinImageController::class, 'update']);
    Route::delete('/cabin-images/{id}', [CabinImageController::class, 'destroy']);

    // Imágenes de usuario (público o privado, según tu caso)
    Route::apiResource('user-images', UserImageController::class)->except(['index', 'show']);

    
    
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('refunds', RefundController::class);

    // Crear comentario requiere estar logueado
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

    Route::apiResource('review-alerts', ReviewAlertController::class);
    
    Route::apiResource('chats', ChatController::class);
    Route::apiResource('chat-messages', ChatMessageController::class);
    Route::apiResource('access-logs', AccessLogController::class);
    Route::post('/availabilities', [AvailabilityController::class, 'store']);
    Route::put('/availabilities/{id}', [AvailabilityController::class, 'update']);
    Route::delete('/availabilities/{id}', [AvailabilityController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

