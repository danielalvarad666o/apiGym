<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HorarioClase;
use App\Models\RegistroClase;

class RegistrarClaseController extends Controller
{
    /**
     * Registrar un usuario en una clase con horario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registrarUsuario(Request $request)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'horario_clase_id' => 'required|exists:horarios_clases,id',
        ]);

        // Buscar el usuario y el horario de la clase
        $user = User::find($validated['user_id']);
        $horarioClase = HorarioClase::find($validated['horario_clase_id']);

        // Verificar si el horario tiene cupo disponible
        $clase = $horarioClase->clase;
        $registroCount = $horarioClase->registros()->count();
        if ($registroCount >= $clase->max_participantes) {
            return response()->json(['error' => 'No hay cupo disponible en esta clase'], 400);
        }

        // Registrar al usuario en la clase
        $registro = RegistroClase::create([
            'user_id' => $user->id,
            'horario_clase_id' => $horarioClase->id,
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente en la clase',
            'registro' => $registro,
        ]);
    }
}
