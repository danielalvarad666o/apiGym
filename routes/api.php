<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gym\UserController;
use App\Http\Controllers\gym\userClasController;

use Illuminate\Http\Request;
use App\Models\HorarioClase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); // Lista de usuarios
    Route::get('/{id}', [UserController::class, 'show']); // Mostrar un usuario específico
    Route::put('update/{id}', [UserController::class, 'update']); // Actualizar usuario
    Route::post('/{id}/status', [UserController::class, 'updateStatus']); // Actualizar estado del usuario
    Route::delete('/{id}', [UserController::class, 'destroy']); // Eliminar usuario
    Route::post('/cUser', [UserController::class, 'crearUser']);
    Route::post('/login', [UserController::class, 'login']);
});
Route::get('/', function () {
    return response()->json("Conexión correcta", 200);
});
Route::get('horarios', function () {
    $hc = DB::table('horarios_clases')->get()->toArray();

    return response()->json((object)$hc);
});

Route::get('clases', function () {
    $hc = DB::table('clases')->get()->toArray();

    return response()->json((object)$hc);;
});


Route::get('entrenadores', function () {
    $hc = DB::table('entrenadores')->get()->toArray();

    return response()->json((object)$hc);;
});

Route::get('membresias', function () {
    $hc = DB::table('membresias')->get()->toArray();

    return response()->json((object)$hc);;
});


Route::get('statuses', function () {
    $hc = DB::table('statuses')->get()->toArray();

    return response()->json((object)$hc);;
});


Route::get('clasesall', function () {
    $clases = HorarioClase::with(['clase', 'entrenador'])->get();

    return response()->json([
        'success' => true,
        'data' => $clases,
    ]);
});

use App\Http\Controllers\UsuarioClasController;

// Rutas para la API de gestión de clases y usuarios

// Obtener todas las clases disponibles
Route::get('/clases/{id}', [userClasController::class, 'index']);


// Obtener las clases inscritas por un usuario
Route::get('/usuarios/{userId}/clases', [userClasController::class, 'misClases']);

// Inscribir a un usuario en una clase
Route::post('/inscribiraclase', [userClasController::class, 'inscribir']);

// Desinscribir a un usuario de una clase
Route::delete('/desinscribir/{userId}/{classId}', [userClasController::class, 'desinscribir']);


Route::get('/claseinf/{claseId}', function ($claseId) {

    $clase = HorarioClase::with(['clase', 'entrenador'])
        ->where('id', $claseId)
        ->first(); // Obtén un único registro

    // Verifica si la clase existe
    if (!$clase) {
        return response()->json([
            'success' => false,
            'message' => 'Clase no encontrada',
        ], 404);
    }

    // Retorna la información de la clase y las relaciones
    return response()->json([
        'success' => true,
        'data' => $clase,
    ]);
});
