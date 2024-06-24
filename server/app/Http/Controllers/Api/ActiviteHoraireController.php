<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\ActiviteHoraire;
use App\Models\Horaire;
use Illuminate\Http\Request;

class ActiviteHoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Activite $activite)
    {
        return $activite->horairesactivite;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Activite $activite)
    {
        $validatedData = $request->validate([
            'Numero de seance' => 'required|integer|min:0|max:3',
            'jour' => 'required|string|max:255',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut'
        ]);
        $horaire = Horaire::where('jour', $validatedData['jour'])
            ->where('heure_debut', $validatedData['heure_debut'])
            ->where('heure_fin', $validatedData['heure_fin'])
            ->firstOrFail();

        // Vérifier si une séance avec le même jour existe déjà pour l'activité spécifiée
        $existingSeance = ActiviteHoraire::where('activite_id', $activite->id)
        ->whereHas('horaire', function($query) use ($validatedData) {
            $query->where('jour', $validatedData['jour']);
        })->exists();

        if ($existingSeance) {
            return response()->json([
                'message' => 'Une séance pour cette activité est déjà programmée ce jour-là.'
            ], 400);
        }

        // Création d'une nouvelle association ActiviteHoraire
        $horaire_seance = ActiviteHoraire::create([
            'num_seance' => $validatedData['Numero de seance'],
            'activite_id' => $activite->id,
            'horaire_id' => $horaire->id,
        ]);
        return $horaire_seance;
    }

    /**
     * Display the specified resource.
     */
    public function show(Activite $activite, string $activiteHoraire)
    {
        return $activite->horairesactivite()
        ->where('activite_horaires.id', $activiteHoraire)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activite $activite, string $activitehoraire)
{
    // Rechercher l'ActiviteHoraire à partir de l'activité spécifiée
    $activiteHoraire = $activite->horairesactivite()->where('activite_horaires.id', $activitehoraire)->first();

    // Vérifier si l'ActiviteHoraire existe
    if (!$activiteHoraire) {
        return response()->json([
            'message' => 'La séance spécifiée n\'existe pas pour cette activité.'
        ], 404);
    }

    // Validation des données d'entrée
    $validatedData = $request->validate([
        'Numero de seance' => 'required|integer|min:0|max:3',
        'jour' => 'required|string|max:255',
        'heure_debut' => 'required|date_format:H:i',
        'heure_fin' => 'required|date_format:H:i|after:heure_debut'
    ]);

    // Requête pour chercher dans la table 'horaire'
    $horaire = Horaire::where('jour', $validatedData['jour'])
        ->where('heure_debut', $validatedData['heure_debut'])
        ->where('heure_fin', $validatedData['heure_fin'])
        ->first();

    // Si l'horaire n'est pas trouvé, retourner une erreur
    if (!$horaire) {
        return response()->json([
            'message' => 'L\'horaire spécifié n\'existe pas.'
        ], 404);
    }

    // Vérifier si une séance avec le même jour existe déjà pour l'activité spécifiée
    $existingSeance = ActiviteHoraire::where('activite_id', $activite->id)
        ->whereHas('horaire', function($query) use ($validatedData) {
            $query->where('jour', $validatedData['jour']);
        })
        
        ->exists();

    if ($existingSeance) {
        return response()->json([
            'message' => 'Une séance pour cette activité est déjà programmée ce jour-là.'
        ], 400);
    }

    // Mise à jour des détails de l'ActiviteHoraire
        $activiteHoraire->update([
            'num_seance' => $validatedData['Numero de seance'],
            'horaire_id' => $horaire->id,
        ]);
    //return $horaire;
   return $activiteHoraire;
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activite $activite, string $activiteHoraireId)
    {
        $activiteHoraire = $activite->horairesactivite()
        ->where('activite_horaires.id', $activiteHoraireId)->first();
        $activiteHoraire->delete();
        return response(status: 204);
    }
}
