<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animateur;
use App\Models\User;
use Illuminate\Http\Request;

class AnimateurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Animateur::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $animateur = Animateur::create([
            ... $request->validate([
                'title' => 'required|string|max:255',            // Titre ou description de l'animateur
                'country' => 'required|string|max:255',          // Pays
                'city' => 'required|string|max:255',             // Ville
                'postal' => 'required|string|max:255',           // Code postal
                'address' => 'required|string|max:255',          // Adresse complète
                'province' => 'required|string|max:255',         // Province
                'photo' => 'nullable|string|max:255',            // Photo (facultative)
                'telephone' => 'required|string|max:255',        // Numéro de téléphone
                'date_naissance' => 'required|date'              // Date de naissance
            ]),
            'user_id' => auth()->id(),
        ]);
        return $animateur;
    }

    /**
     * Display the specified resource.
     */
    public function show(Animateur $animateur)
    {
        return $animateur;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animateur $animateur)
    {
        $animateur->update([
            ... $request->validate([
                'title' => 'sometimes|string|max:255',            // Titre ou description de l'animateur
                'country' => 'sometimes|string|max:255',          // Pays
                'city' => 'sometimes|string|max:255',             // Ville
                'postal' => 'sometimes|string|max:255',           // Code postal
                'address' => 'sometimes|string|max:255',          // Adresse complète
                'province' => 'sometimes|string|max:255',         // Province
                'photo' => 'sometimes|string|max:255',            // Photo (facultative)
                'telephone' => 'sometimes|string|max:255',        // Numéro de téléphone
                'date_naissance' => 'sometimes|date'              // Date de naissance
            ])
        ]);
        return $animateur;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animateur $animateur)
    {
        $animateur->delete();
        return response(status: 204);//ca permet de rien retourner
    }
}
