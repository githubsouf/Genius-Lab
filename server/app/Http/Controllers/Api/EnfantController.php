<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enfant;
use App\Models\Parental;
use Illuminate\Http\Request;

class EnfantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Enfant::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Parental $parental)
    {
        $enfant = Enfant::create([
            ... $request->validate([
                'nom' => 'required|string|max:255',          // Pays
                'prenom' => 'required|string|max:255',             // Ville
                'photo' => 'nullable|string|max:255',            // Photo (facultative)
                'date_naissance' => 'required|date',              // Date de naissance
                'genre' => 'required|string'
            ]),
            'parental_id' => $parental->id,
        ]);
        return $enfant;
    }

    /**
     * Display the specified resource.
     */
    public function show(Parental $parental, Enfant $enfant)
    {
        return $enfant;
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parental $parental, Enfant $enfant)
    {
        $enfant->update([
            ... $request->validate([
                'nom' => 'sometimes|string|max:255',          // Pays
                'prenom' => 'sometimes|string|max:255',             // Ville
                'photo' => 'sometimes|string|max:255',            // Photo (facultative)
                'date_naissance' => 'sometimes|date',
                'genre' => 'sometimes|string'
            ])
        ]);
        return $enfant;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parental $parental, Enfant $enfant)
    {
        $enfant->delete();
        return response(status: 204);
    }
}
