<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animateur;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Animateur $animateur)
    {
        return $animateur->experiences;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Animateur $animateur)
    {
        $experience = Experience::create([
            ... $request->validate([
                'title' => 'required|string|max:255',            // Titre ou description de l'animateur
                'company' => 'required|string|max:255',          // Societe
                'country' => 'required|string|max:255',          // Pays
                'city' => 'required|string|max:255',             // Ville
                'statut' => 'nullable|boolean',         // est ce qu'il travaille toujours dans la company
                'start_date' => 'required|date',  // Doit être une date valide
                'end_date' => 'required|date|after:start_date',  // Doit être une date valide et après ou égale à start_date
                'description' => 'nullable|string|max:1000'  // Peut être null, doit être une chaîne, longueur max de 1000 caractères
            ]),
            'animateur_id' => $animateur->id
        ]);
        return $experience;
    }

    /**
     * Display the specified resource.
     */
    public function show(Animateur $animateur, Experience $experience)
    {
        return $experience;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animateur $animateur, Experience $experience)
    {
        $experience->update([
            ... $request->validate([
                'title' => 'sometimes|string|max:255',            // Titre ou description de l'animateur
                'company' => 'sometimes|string|max:255',          // Societe
                'country' => 'sometimes|string|max:255',          // Pays
                'city' => 'sometimes|string|max:255',             // Ville
                'statut' => 'sometimes|boolean',         // est ce qu'il travaille toujours dans la company
                'start_date' => 'sometimes|date',  // Doit être une date valide
                'end_date' => 'sometimes|date|after:start_date',  // Doit être une date valide et après ou égale à start_date
                'description' => 'sometimes|string|max:1000'
            ])
        ]);
        return $experience;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animateur $animateur, Experience $experience)
    {
        $experience->delete();
        return response(status: 204);//ca permet de rien retourner
    }
}
