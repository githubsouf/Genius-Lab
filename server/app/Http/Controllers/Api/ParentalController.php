<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parental;
use Illuminate\Http\Request;

class ParentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Parental::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $parent = Parental::create([
            ... $request->validate([
                'country' => 'required|string|max:255',          // Pays
                'city' => 'required|string|max:255',             // Ville
                'postal' => 'required|string|max:255',           // Code postal
                'address' => 'required|string|max:255',          // Adresse complète
                'province' => 'required|string|max:255',         // Province
                'photo' => 'nullable|string|max:255',            // Photo (facultative)
                'telephone' => 'required|string|max:255',        // Numéro de téléphone
                'date_naissance' => 'required|date',              // Date de naissance
                'genre' => 'required|string'
            ]),
            'user_id' => auth()->id(),
        ]);
        return $parent;
    }

    /**
     * Display the specified resource.
     */
    public function show(Parental $parental)
    {
        return $parental;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parental $parental)
    {
        $parental->update([
            ... $request->validate([
                'country' => 'sometimes|string|max:255',          // Pays
                'city' => 'sometimes|string|max:255',             // Ville
                'postal' => 'sometimes|string|max:255',           // Code postal
                'address' => 'sometimes|string|max:255',          // Adresse complète
                'province' => 'sometimes|string|max:255',         // Province
                'photo' => 'sometimes|string|max:255',            // Photo (facultative)
                'telephone' => 'sometimes|string|max:255',        // Numéro de téléphone
                'genre' => 'sometimes|string'
            ])
        ]);
        return $parental;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parental $parental)
    {
        $parental->delete();
        return response(status: 204);//ca permet de rien retourner
    }
}
