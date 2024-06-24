<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offre;

class OffreController extends Controller
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
        return Offre::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offre = Offre::create([
            ...$request->validate([
            'titre' => 'required|string|max:255|unique:offres', 
            'date_debut' => 'required|date_format:Y-m-d H:i', // Format de date complet
            'date_fin' => 'required|date_format:Y-m-d H:i|after:date_debut', // Utilisez 'date_debut' pour la comparaison
            'description' => 'required|string|max:65535',
            'photo' => 'nullable|string|max:255',   
            'remise' => 'nullable|integer|min:0|max:100' // Si 'remise' n'est pas spécifié, la valeur par défaut sera 0
            ]),
            'administrateur_id' => auth()->id(),
        ]);
        return $offre;
    }

    /**
     * Display the specified resource.
     */
    public function show(Offre $offre)
    {
        return $offre;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offre $offre)
    {
        $offre->update([
            ...$request->validate([
            'titre' => 'sometimes|string|max:255|unique:offres', 
            'date_debut' => 'sometimes|date_format:Y-m-d H:i', // Format de date complet
            'date_fin' => 'sometimes|date_format:Y-m-d H:i|after:date_debut', // Utilisez 'date_debut' pour la comparaison
            'description' => 'sometimes|string|max:65535',
            'remise' => 'nullable|integer|min:0|max:100' // Si 'remise' n'est pas spécifié, la valeur par défaut sera 0
            ])
        ]);
        return $offre;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offre $offre)
    {
        $offre->delete();
        return response(status: 204);
    }
}
