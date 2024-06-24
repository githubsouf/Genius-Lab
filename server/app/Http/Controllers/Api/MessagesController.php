<?php

namespace App\Http\Controllers\Api;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class MessagesController extends Controller
{
    // Récupérer toutes les conversations
    public function index($conversationId)
    {
        $messages = Message::where('conversation_id', $conversationId)->get();
        return response()->json($messages);
    }

    // Envoyer un message dans une conversation spécifique
    public function store(Request $request, $conversationId)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',  
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $message = new Message([
            'body' => $request->input('body'),
            'conversation_id' => $conversationId,
            'user_id' => $request->input('user_id'),
        ]);
        $message->save();
    
        broadcast(new MessageSent($message))->toOthers();
    
        return response()->json($message, 201);
    }
}