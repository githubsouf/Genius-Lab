<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animateur;
use App\Models\Langue;
use App\Models\LangueAnimateur;
use Illuminate\Http\Request;

class LangueAnimateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Animateur $animateur)
    {
        return $animateur->langues;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Animateur $animateur)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'langue' => 'required|string',
            'proficiency' => 'required|string'
        ]);

        // Trouver l'ID de la langue basée sur le nom fourni
        $langue = Langue::where('language_name', $validatedData['langue'])
        ->firstOrFail();

        $langueanimateur = LangueAnimateur::create([
            'langue_id' => $langue->id,
            'proficiency' =>  $validatedData['proficiency'],
            'animateur_id' => $animateur->id
        ]);
        return $langueanimateur;
    }


    /**
     * Display the specified resource.
     */
    public function show(Animateur $animateur, string $langueAnimateurId)
    {
        /*
        $langueAnimateur = LangueAnimateur::findOrFail($langueAnimateurId);
        return $langueAnimateur;
        */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animateur $animateur, LangueAnimateur $langueAnimateur)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animateur $animateur, string $langueAnimateurId)
    {
        $langueAnimateur = LangueAnimateur::findOrFail($langueAnimateurId);
        $langueAnimateur->delete();
        return response(status: 204);//ca permet de rien retourner
    }
}
