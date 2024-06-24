<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\DemandeActiviteEnfant;
use Illuminate\Http\Request;

class DemandeActiviteEnfantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Demande $demande)
    {
        return $demande->demandeActiviteEnfants;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Demande $demande)
    {
        // Validate the input
        $validatedData = $request->validate([
            'activite_id' => 'required|array',
            'activite_id.*' => 'integer', // Ensure each element in the array is an integer
            'enfant_id' => 'required|array',
            'enfant_id.*' => 'integer', // Ensure each element in the array is an integer
            'modalite' => 'required|string'
        ]);

        // Get the arrays
        $activiteIds = $validatedData['activite_id'];
        $enfantIds = $validatedData['enfant_id'];

        // Iterate over enfant_ids and for each enfant_id, iterate over activite_ids
        foreach ($enfantIds as $enfantId) {
            foreach ($activiteIds as $activiteId) {
                DemandeActiviteEnfant::create([
                    'activite_id' => $activiteId,
                    'enfant_id' => $enfantId,
                    'demande_id' => $demande->id,
                    'modalite' => $validatedData['modalite']
                ]);
            }
        };
        return response()->json(['message' => 'Data successfully inserted.'], 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demande $demande, DemandeActiviteEnfant $activitesenfant)
{
    // Validate the input
    $validatedData = $request->validate([
        'activite_id' => 'sometimes|array',
        'activite_id.*' => 'integer', // Ensure each element in the array is an integer
        'enfant_id' => 'sometimes|array',
        'enfant_id.*' => 'integer', // Ensure each element in the array is an integer
        'modalite' => 'sometimes|string'
    ]);

    // Get the arrays if they are provided
    $activiteIds = $validatedData['activite_id'] ?? [];
    $enfantIds = $validatedData['enfant_id'] ?? [];
    $modalite = $validatedData['modalite'] ?? null;

    // If activite_id and enfant_id are both provided, update them
    if (!empty($activiteIds) && !empty($enfantIds)) {
        // Delete existing entries for the demande
        DemandeActiviteEnfant::where('demande_id', $demande->id)->delete();

        // Iterate over enfant_ids and for each enfant_id, iterate over activite_ids
        foreach ($enfantIds as $enfantId) {
            foreach ($activiteIds as $activiteId) {
                DemandeActiviteEnfant::create([
                    'activite_id' => $activiteId,
                    'enfant_id' => $enfantId,
                    'demande_id' => $demande->id,
                    'modalite' => $modalite
                ]);
            }
        }
    } elseif (!empty($modalite)) {
        // If only modalite is provided, update all related records' modalite
        DemandeActiviteEnfant::where('demande_id', $demande->id)->update(['modalite' => $modalite]);
    }

    return response()->json(['message' => 'Data successfully updated.'], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        $demande->demandeActiviteEnfants()->delete();
        return response(status: 204);
    }
}
