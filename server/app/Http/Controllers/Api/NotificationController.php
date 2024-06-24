<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewNotification;
use App\Models\User;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return Notification::where('user_id', $request->user()->id)->where('read_at', null)->get();
        //return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification->user_id != auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->read_at != null;
        $notification->save();

        return response()->json(['message' => 'Notification marquée comme lue.']);
    }


    public function sendNotification(Request $request)
    {
        // Récupérer l'ID de l'utilisateur à partir du corps de la requête
        $userId = $request->input('user_id');
        
        // Récupérer l'utilisateur correspondant à partir de la base de données
        $user = User::find($userId);

        // Vérifier si l'utilisateur existe
        if ($user) {
            // Créer une nouvelle notification en utilisant l'ID de l'utilisateur
            $notification = new NewNotification($request->input('message'), $userId);

            // Envoyer la notification
            $user->notify($notification);

            // Retourner une réponse réussie
            return response()->json(['message' => 'Notification envoyée avec succès'], 200);
        } else {
            // Retourner une réponse avec erreur si l'utilisateur n'existe pas
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }
    
}
