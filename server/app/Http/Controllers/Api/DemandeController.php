<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Parental;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Parental $parental)
    {
        return $parental->demandes;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Parental $parental)
    {
        $demande = Demande::create([    
            'parental_id' => $parental->id
        ]);
        return $demande;
    }//description

    /**
     * Display the specified resource.
     */
    public function show(Parental $parental, Demande $demande)
    {
        return $demande;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parental $parental, Demande $demande)
    {
        $demande->update([
            ... $request->validate([
                'statut' => 'required|integer|in:0,1'
            ])
        ]); 
        return $demande;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parental $parental, Demande $demande)
    {
        $demande->delete();
        return response(status: 204);
    }
}
