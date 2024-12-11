<?php

namespace App\Http\Controllers\gym;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsuarioClas;
use App\Models\HorarioClase;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class userClasController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el usuario autenticado




        // Obtener el ID del usuario autenticado
        $userId = $request->id;


        // Obtener las clases en las que el usuario no está inscrito
        $inscripciones = UsuarioClas::where('user_id', $userId)->pluck('horario_clase_id');


        $clases = HorarioClase::with(['clase', 'entrenador'])
            ->whereNotIn('id', $inscripciones)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $clases,
        ]);
    }


    // Mostrar las clases inscritas de un usuario
    public function misClases($userId)
    {
        // Verificar si el usuario existe
        $usuario = User::findOrFail($userId);

        // Obtener los horarios a los que el usuario está inscrito y cargar relaciones
        $clases = $usuario->horarios()->with(['clase', 'entrenador'])->get();

        return response()->json([
            'success' => true,
            'data' => $clases,
        ]);
    }


    // Inscribir a un usuario en una clase
    public function inscribir(Request $request)
    {
        $validacion = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|exists:users,id',
                'horario_clase_id' => 'required|exists:horarios_clases,id',

            ]
        );
        if ($validacion->fails()) {
            return response()->json([
                "status" => 400,
                "msg" => "No se cumplieron las validaciones",
                "error" => $validacion->errors(),
                "data" => null,
            ], 400);
        }




        // Verificar si ya está inscrito
        $existe = UsuarioClas::where('user_id', $request->user_id)
            ->where('horario_clase_id', $request->horario_clase_id)
            ->exists();

        if ($existe) {
            return response()->json([
                'success' => false,
                'message' => 'Ya estás inscrito en esta clase.',
            ], 400);
        }

        $inscripcion = UsuarioClas::create([
            'user_id' => $request->user_id,
            'horario_clase_id' => $request->horario_clase_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Te has inscrito correctamente.',
            'data' => $inscripcion,
        ]);
    }

    // Eliminar inscripción de una clase
    public function desinscribir($userId, $classId)
    {
        // Buscar la inscripción basada en el ID del usuario y de la clase
        $inscripcion = UsuarioClas::where('user_id', $userId)
            ->where('horario_clase_id', $classId)
            ->first();

        // Validar si la inscripción existe
        if (!$inscripcion) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró la inscripción especificada.',
            ], 404);
        }

        // Eliminar la inscripción
        $inscripcion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Te has desinscrito correctamente de la clase.',
        ]);
    }
}
