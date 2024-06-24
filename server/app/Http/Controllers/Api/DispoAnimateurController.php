<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animateur;
use App\Models\DispoAnimateur;
use App\Models\Horaire;
use Illuminate\Http\Request;

class DispoAnimateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Animateur $animateur)
    {
        return $animateur->horairesdispo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Animateur $animateur)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'jour'=> 'required|string',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut'
        ]);
        // Trouver l'horaire basé sur le jour, heure_debut, et heure_fin
        $horaire = Horaire::where('jour', $validatedData['jour'])
            ->where('heure_debut', $validatedData['heure_debut'])
            ->where('heure_fin', $validatedData['heure_fin'])
            ->firstOrFail();

        $dispoanimateur = DispoAnimateur::create([
            'horaire_id' => $horaire->id,
            'animateur_id' => $animateur->id
        ]);
        return $dispoanimateur;
    }

    /**
     * Display the specified resource.
     */
    public function show(Animateur $animateur, string $dispoanimateurId)
    {
        $dispoanimateur = DispoAnimateur::findOrFail($dispoanimateurId);
        return $dispoanimateur;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animateur $animateur, string $dispoanimateurId)
    {
        $dispoanimateur = DispoAnimateur::findOrFail($dispoanimateurId);
        $dispoanimateur->delete();
        return response(status: 204);
    }
}
    