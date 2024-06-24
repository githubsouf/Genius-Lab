<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animateur;
use App\Models\AnimateurCategorieService;
use App\Models\Categorie;
use App\Models\Service;
use Illuminate\Http\Request;

class AnimateurCategorieServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Animateur $animateur)
    {
        $servicesMaitrises = $animateur->servicesMaitrises()->get(); 
        return response()->json($servicesMaitrises);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Animateur $animateur)
    {
         // Valider la requête
        $validatedData = $request->validate([
            'categorie' => 'required|string',
            'service' => 'required|string'
        ]);
        // Trouver l'ID de la langue basée sur le nom fourni
        $categorie = Categorie::where('domaine', $validatedData['categorie'])
        ->firstOrFail();
        // Trouver l'ID de la langue basée sur le nom fourni
        $service = Service::where('service_name', $validatedData['service'])
        ->firstOrFail();

        $serviceanimateur = AnimateurCategorieService::create([
            'categorie_id' => $categorie->id,
            'service_id' =>  $service ->id,
            'animateur_id' => $animateur->id
        ]);
        return $serviceanimateur;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Animateur $animateur, string $animateurservicesId)
    {
        //apres pour utiliser model binding try d'utiliser la variable suivant animateurcategorieservice
        $animateurservices = AnimateurCategorieService::findOrFail($animateurservicesId);
        $animateurservices->delete();
        return response(status: 204);
    }
}
