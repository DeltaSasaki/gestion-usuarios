<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Agregamos el middleware 'throttle:60,1' para limitar las peticiones.
// Esto protege contra ataques de fuerza bruta en los endpoints de login y registro.
Route::middleware('throttle:60,1')->group(function () {
    // Rutas públicas (no requieren autenticación)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rutas protegidas que requieren un token de autenticación
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Grupo de rutas que solo pueden ser accedidas por un usuario con rol 'admin'.
        // Aquí es donde se aplica el middleware que creamos.
        Route::middleware('admin')->group(function () {
            Route::get('/users', [UserController::class, 'index']);
        });
    });
});
