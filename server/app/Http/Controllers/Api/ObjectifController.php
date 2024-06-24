<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Administrateur;
use App\Models\Objectif;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ObjectifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Objectif::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Activite $activite)
    {
        $objectif = Objectif::create([
            ...$request->validate([
               'objectifs_detailles' => 'required|string|max:255'
            ]),
            'activite_id' => $activite->id
        ]);
        return $objectif;        
    }

    /**
     * Display the specified resource.
     */
    public function show(Activite $activite, Objectif $objectif)
    {
        return $objectif;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activite $activite, Objectif $objectif)
    {
        $objectif->update([
            ...$request->validate([
               'objectifs_detailles' => 'sometimes|string|max:255'
            ]),
        ]);
        return $objectif;   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activite $activite, Objectif $objectif)
    {
        $objectif->delete();
        return response(status: 204);
    }
}
