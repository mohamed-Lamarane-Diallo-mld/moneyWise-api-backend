<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordResetController extends Controller
{
    //  Demande de réinitialisation du mot de passe (envoi du mail)
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Nettoyer les tokens expirés (1h)
        DB::table('password_resets')->where('created_at', '<', now()->subHour())->delete();

        // Générer token aléatoire
        $token = Str::random(60);

        // Stocker hash du token
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // URL du front pour la réinitialisation
        $frontendUrl = 'https://moneywise-frontend.vercel.app/auth/password_reset';
        $url = $frontendUrl . "?token=$token&email={$request->email}";

        // Envoi du mail HTML
        Mail::send([], [], function ($message) use ($request, $url) {
            $message->to($request->email)
                ->subject('Réinitialisation du mot de passe')
                ->html(
                    "<p>Vous avez demandé une réinitialisation de mot de passe.</p>
                    <p>Cliquez sur le bouton ci-dessous pour créer un nouveau mot de passe :</p>
                    <a href='$url' style='display:inline-block;padding:10px 20px;background:#1d4ed8;color:white;text-decoration:none;border-radius:5px;'>Réinitialiser le mot de passe</a>
                    <p>Si vous n'avez pas demandé cette action, ignorez cet email.</p>"
                );
        });

        return response()->json(['message' => 'Email envoyé avec succès !']);
    }


    // Réinitialisation du mot de passe avec token
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Supprimer tokens expirés
        DB::table('password_resets')->where('created_at', '<', now()->subHour())->delete();

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return response()->json(['success' => false, 'message' => 'Token invalide ou expiré'], 400);
        }

        // Mettre à jour le mot de passe
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Supprimer le token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['success' => true, 'message' => 'Mot de passe réinitialisé avec succès !']);
    }
}
