<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConversationsController extends Controller
{
    // Récupérer toutes les conversations
    public function index()
    {
        $conversations = Conversation::all();
        return response()->json($conversations);
    }

    // Récupérer une conversation spécifique
    public function show($id)
    {
        $conversation = Conversation::findOrFail($id);
        return response()->json($conversation);
    }

    // Créer une nouvelle conversation
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $conversation = Conversation::create($request->all());
        return response()->json($conversation, 201);
    }
}
