<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class AuthController extends Controller
{
    // Connexion
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = JWTAuth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, JWTAuth::guard('api')->user());
    }

    // Inscription
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::guard('api')->login($user);

        return $this->respondWithToken($token, $user);
    }

    // Déconnexion
    public function logout()
    {
        JWTAuth::guard('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Rafraîchir le token
    public function refresh()
    {
        $token = JWTAuth::guard('api')->refresh();
        return $this->respondWithToken($token, JWTAuth::guard('api')->user());
    }

    // Profil utilisateur
    public function me()
    {
        return response()->json(JWTAuth::guard('api')->user());
    }

    // Réponse standardisée
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'user'  => $user,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}

