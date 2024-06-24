<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
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
        return Activite::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $activite = Activite::create([
            ...$request->validate([
                'titre' => 'required|string|max:255|unique:activites',                 // Titre de l'activité
                'description' => 'required|string|max:65535',        // Description de l'activité
                'age_min' => 'required|integer|min:0',                // Âge minimum
                'age_max' => 'required|integer|min:0',                // Âge maximum
                'type_activite' => 'required|string|max:255',         // Type d'activité (atelier, labo, ...)
                'eff_min' => 'required|integer|min:0',                // Effectif minimum
                'eff_max' => 'required|integer|min:0',                // Effectif maximum
                'nom' => 'required|string|max:255',                   // Nom de l'activité
                'categorie' => 'required|string|max:255',             // Catégorie de l'activité
                'service' => 'required|string|max:255',               // Service associé
                'photo' => 'nullable|string|max:255',                 // Photo (facultative)
                'mode_de_realisation' => 'required|string|max:255',   // Mode de réalisation ('presentiel' ou 'distance')
                'nbre_seance' => 'required|integer|min:0',            // Nombre de séances
                'prix' => 'required|integer|min:0', 
            ]),
            'administrateur_id' => auth()->id(), // Cela suppose que vous avez une colonne administrateur_id pour lier à un administrateur connecté
        ]);
        return $activite;
    }

    /**
     * Display the specified resource.
     */
    public function show(Activite $activite)
    {
        return $activite;
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activite $activite)
    {
        $activite->update([
            ...$request->validate([
                'titre' => 'sometimes|string|max:255',                 // Titre de l'activité
                'description' => 'sometimes|string|max:65535',        // Description de l'activité
                'age_min' => 'sometimes|integer|min:0',                // Âge minimum
                'age_max' => 'sometimes|integer|min:0|max:17',                // Âge maximum
                'type_activite' => 'sometimes|string|max:255',         // Type d'activité (atelier, labo, ...)
                'eff_min' => 'sometimes|integer|min:0',                // Effectif minimum
                'eff_max' => 'sometimes|integer|min:0',                // Effectif maximum
                'nom' => 'sometimes|string|max:255',                   // Nom de l'activité
                'categorie' => 'sometimes|string|max:255',             // Catégorie de l'activité
                'service' => 'sometimes|string|max:255',               // Service associé
                'photo' => 'nullable|string|max:255',                 // Photo (facultative)
                'mode_de_realisation' => 'sometimes|string|max:255',   // Mode de réalisation ('presentiel' ou 'distance')
                'nbre_seance' => 'sometimes|integer|min:0',            // Nombre de séances
            ]),
        ]);
        return $activite;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activite $activite)
    {
        $activite->delete();
        return response(status: 204);
    }
}
