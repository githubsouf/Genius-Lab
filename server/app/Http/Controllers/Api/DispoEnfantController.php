<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DispoEnfant;
use App\Models\Enfant;
use App\Models\Horaire;
use Illuminate\Http\Request;

class DispoEnfantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Enfant $enfant)
    {
        return $enfant->horairesdispo;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Enfant $enfant)
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

        $dispoenfant = DispoEnfant::create([
            'horaire_id' => $horaire->id,
            'enfant_id' => $enfant->id
        ]);
        return $dispoenfant;
    }

    /**
     * Display the specified resource.
     */
    public function show(Enfant $enfant, DispoEnfant $dispoenfant)
    {
        //a voir
        return $enfant->$dispoenfant;
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
    public function destroy(string $id)
    {
        //
    }
}
