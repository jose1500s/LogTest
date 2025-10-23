<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        
         if (!$request->name || !$request->email || !$request->password) {
            return response()->json(['message' => 'Todos los campos son obligatorios'], 422);
        }
        

        if (User::where('email', $request->email)->exists()) {
                return response()->json(['message' => 'El correo ya está en uso'], 409);
        }

        if (strlen($request->password) < 8) {
            return response()->json(['message' => 'La contraseña debe tener al menos 8 caracteres'], 422);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['message' => 'El correo no es válido'], 422);
        }


       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
       ]);
       
       $token = $user->createToken('API Token')->plainTextToken;

         return response()->json([
              'user' => $user,
              'token' => $token,
         ], 201);

    }

   public function login(AuthRequest $request)
{

    $user = User::where('email', $request->email)->first();

    if (!$request->email || !$request->password) {
        return response()->json(['message' => 'Correo y Contraseña son obligatorios'], 422);
    }

     if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['message' => 'El correo no es válido'], 422);
    }

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Correo o Contraseña Incorrectos'], 401);
    }

     $user->tokens()->delete();

    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'user'  => $user,
        'token' => $token,
    ], 200);
}

public function logout(Request $request)
{
   
    $request->user()->currentAccessToken()->delete();

    return response()->noContent(); // 204
}

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
