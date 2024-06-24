<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Horaire;
use Illuminate\Http\Request;

class HoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Horaire::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $horaire = Horaire::create([
            ... $request->validate([
                'jour' => 'required|string|max:255',
                'heure_debut' => 'required|date_format:H:i',
                'heure_fin' => 'required|date_format:H:i|after:heure_debut'
            ]),
        ]);
        return $horaire;
    }

    /**
     * Display the specified resource.
     */
    public function show(Horaire $horaire)
    {
        return $horaire;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horaire $horaire)
    {
        $horaire->update([
            ... $request->validate([
                'jour' => 'sometimes|string|max:255',
                'heure_debut' => 'sometimes|date_format:H:i',
                'heure_fin' => 'sometimes|date_format:H:i|after:heure_debut'
            ]),
        ]);
        return $horaire;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horaire $horaire)
    {
        $horaire->delete();
        return response(status: 204);
    }
}
