<?php

namespace App\Http\Controllers\gym;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{

    //
    /**
     * Mostrar una lista de clientes.
     */
    public function index()
    {
        $users = User::with('status')->get(); // Incluye información del estado
        return response()->json($users, 200);
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show($id)
    {
        $user = User::with('status')->find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user, 200);
    }

    /**
     * Actualizar un usuario.
     */
    public function update(Request $request, $id)
    {
        // Buscar el usuario por ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Validar los datos del request
        $validated = Validator::make(
            $request->all(),
            [
                'name' => 'string|max:255|nullable',
                'email' => 'email|unique:users,email,' . $id . '|nullable',
                'phone' => 'string|max:15|nullable',
                'birth_date' => 'date|nullable',
            ]
        );

        if ($validated->fails()) {
            return response()->json([
                "status" => 400,
                "msg" => "No se cumplieron las validaciones",
                "error" => $validated->errors(),
                "data" => null,
            ], 400);
        }

        // Actualizar los datos del usuario
        $user->update($validated->validated());

        return response()->json([
            'message' => 'Usuario actualizado con éxito',
            'user' => $user,
        ], 200);
    }


    /**
     * Actualizar el estado de un usuario.
     */
    public function updateStatus(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $user->status_id = $request->status_id;
        $user->save();

        return response()->json(['message' => 'Estado actualizado con éxito', 'user' => $user], 200);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validacion = Validator::make(
            $request->all(),
            [
                'email' => "required|string|email:rfc,dns",
                'password' => "required|string|min:4",
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

        // Buscar el usuario por email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                "status" => 404,
                "msg" => "Usuario no encontrado",
                "data" => null,
            ], 404);
        }

        // Verificar la contraseña
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => 401,
                "msg" => "Credenciales inválidas",
                "data" => null,
            ], 401);
        }

        // Verificar si el status_id es igual a 1
        if ($user->status_id != 1) {
            return response()->json([
                "status" => 403,
                "msg" => "El usuario no está activo",
                "data" => null,
            ], 403);
        }

        // Generar un token (usando Sanctum o Passport)


        return response()->json([
            "status" => 200,
            "msg" => "Inicio de sesión exitoso",
            "data" => [
                "user" => $user,
                "token" => $user->createToken("Token")->plainTextToken,
            ],
        ], 200);
    }



    public function crearUser(Request $request)
    {
        // Validaciones
        $validacion = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:20",

                'email' => "required|string|email:rfc,dns|unique:users,email",
                'password' => "required|string|min:4",
                'phone' => "required|string|min:10|max:10|unique:users",
                'birth_date' => "required"
            ]
        );

        // Si la validación falla
        if ($validacion->fails()) {
            return response()->json([
                "status" => 400,
                "msg" => "No se cumplieron las validaciones",
                "error" => $validacion->errors(),
                "data" => null,
            ], 400);
        }

        // Crear nuevo usuario
        $user = new User();
        $user->name = $request->name;

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->status_id = 1;
        // Encriptar la contraseña antes de guardarla
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return response()->json([
                "message" => "¡Registro agregado correctamente!",
                "user" => $user
            ], 201);
        } else {
            return response()->json([
                "message" => "Usuario no creado"
            ], 500);
        }
    }
}
