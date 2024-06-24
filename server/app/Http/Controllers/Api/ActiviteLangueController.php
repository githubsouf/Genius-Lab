<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\ActiviteLangue;
use App\Models\Langue;
use Illuminate\Http\Request;

class ActiviteLangueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Activite $activite)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Activite $activite)
    {
        $validatedData = $request->validate([
            'langue' => 'required|string'
        ]);
        // Trouver l'ID de la langue basée sur le nom fourni
        $langue = Langue::where('language_name', $validatedData['langue'])
        ->firstOrFail();

        $langueActivite = ActiviteLangue::create([
            'langue_id' => $langue->id,
            'activite_id' =>  $activite ->id
        ]);
        return $langueActivite;
    }

    /**
     * Display the specified resource.
     */
    public function show(Activite $activite, string $activitelangueId)
    {
        return $activite->langues()->where('activite_langues.id', $activitelangueId)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
