<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Notification\VerifyEmailNotification;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create(
            $request->validate([
                'name' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8'
            ])
        );

        // Envoyer la notification de vérification par email
        $user->notify(new VerifyEmailNotification($user->id));

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update(
            ... $request->validate([
                'name' => 'sometimes|string|max:255',
                'prenom' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email', // Email requis, doit être valide, unique dans la table 'users'
                'password' => 'sometimes|string|min:8' // Mot de passe requis, doit être une chaîne, minimum 8 caractères
            ])
            );
            return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(status: 204);//ca permet de rien retourner
    }

    public function verifyEmail($userId)
    {
        $user = User::findOrFail($userId);

        // Vérifier si l'email est déjà vérifié
        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email already verified.'], 200);
        }

        // Mettre à jour la colonne email_verified_at
        $user->update(['email_verified_at' => now()]);

        // Retourner un message de succès
        return response()->json(['message' => 'Email verified successfully!'], 200);
    }
}
