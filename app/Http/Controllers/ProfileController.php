<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
  
    public function crearToken(Request $request) 
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'error' => 'No autenticado',
            'message' => 'Debes estar autenticado para generar un token'
        ], 401);
    }

    // Elimina tokens anteriores
    $user->tokens()->delete();

    // Definimos los permisos según el rol
    $permisosPorRol = [
        'admin' => ['gestor-admin'],
        'profesor' => ['gestor-profesor'],
        'alumno' => ['gestor-alumno'],
    ];

    if (!array_key_exists($user->rol, $permisosPorRol)) {
        return response()->json([
            'error' => 'Tipo de usuario no reconocido',
            'message' => 'El rol proporcionado no tiene permisos asignados'
        ], 403);
    }

    // Genera el token con nombre y permisos
    $tokenName = 'token-' . $user->rol . 'es';
    $token = $user->createToken($tokenName, $permisosPorRol[$user->rol])->plainTextToken;

    return response()->json([
        'rol' => $user->rol,
        'token' => $token
    ]);
}

      
}
