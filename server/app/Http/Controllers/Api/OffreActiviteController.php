<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Offre;
use App\Models\OffreActivite;
use Illuminate\Http\Request;

class OffreActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Offre $offre)
    {
        return $offre->activites;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Offre $offre)
    {
        $validatedData = $request->validate([
            'nom_activite' => 'required|string',
        ]);

        $activite = Activite::where('titre', $validatedData['nom_activite'])
        ->firstOrFail();

        $offreActivite = OffreActivite::create([
            'offre_id' => $offre->id,
            'activite_id'=>  $activite ->id
        ]);
        return $offreActivite;
    }

    /**
     * Display the specified resource.
     */
    public function show(Offre $offre, string $offreActiviteId)
    {
        return OffreActivite::findOrFail($offreActiviteId);
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
    public function destroy(Offre $offre, string $offreActiviteId)
    {
        $offreActivite = OffreActivite::findOrFail($offreActiviteId);
        $offreActivite->delete();
        return response(status: 204);
    }
}
