<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    /**
     * Registro de usuarios
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'    => 'required|string|max:20',
            'apellidos' => 'required|string|max:30',
            'email'     => 'required|string|email|max:50|unique:users',
            'password'  => 'required|string|min:8|max:20|confirmed',
            'rol'       => 'required|in:admin,alumno,profesor',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $codigo_usuario = User::generarCodigoUnico($request->nombre, $request->apellidos);

        $user = User::create([
            'nombre'         => $request->nombre,
            'apellidos'      => $request->apellidos,
            'codigo_usuario' => $codigo_usuario,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'rol'            => $request->rol,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'       => true,
            'message'      => 'Usuario registrado correctamente',
            'user'         => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 201);
    }

    /**
     * Login de usuarios
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
            ], 422);
        }

        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => false,
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        $user  = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'       => true,
            'message'      => 'Usuario autenticado correctamente',
            'user'         => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }
}
