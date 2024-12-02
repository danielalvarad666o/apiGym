<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gym\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); // Lista de usuarios
    Route::get('/{id}', [UserController::class, 'show']); // Mostrar un usuario específico
    Route::put('/{id}', [UserController::class, 'update']); // Actualizar usuario
    Route::patch('/{id}/status', [UserController::class, 'updateStatus']); // Actualizar estado del usuario
    Route::delete('/{id}', [UserController::class, 'destroy']); // Eliminar usuario
    Route::post('/cUser',[UserController::class,'crearUser']);
});

