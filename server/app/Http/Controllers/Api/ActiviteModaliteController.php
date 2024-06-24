<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\ActiviteModalite;
use App\Models\Modalite;
use Illuminate\Http\Request;

class ActiviteModaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Activite $activite)
    {
        return $activite->modalitesDePaiement;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Activite $activite)
    {

        $validatedData = $request->validate([
            'modalite_de_paiement' => 'required|string'
        ]);

        $modalite = Modalite::where('type_modalite', $validatedData['modalite_de_paiement'])
        ->firstOrFail();

        $activitemodalite = ActiviteModalite::create([
            'modalite_id' => $modalite->id,
            'activite_id' =>  $activite ->id
        ]);
        return $activitemodalite;
    }

    /**
     * Display the specified resource.
     */
    public function show(Activite $activite, string $activitemodaliteId)
    {
        return ActiviteModalite::findOrFail($activitemodaliteId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activite $activite, string $activitemodaliteId)
{
    $validatedData = $request->validate([
        'modalite_de_paiement' => 'required|string'
    ]);

    $modalite = Modalite::where('type_modalite', $validatedData['modalite_de_paiement'])
        ->firstOrFail();

    $activitemodalite = ActiviteModalite::findOrFail($activitemodaliteId);
    $activitemodalite->update([
        'modalite_id' => $modalite->id,
    ]);
    return $activitemodalite;
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activite $activite, string $activitemodaliteId)
    {
        $activitemodalite = ActiviteModalite::findOrFail($activitemodaliteId);
        $activitemodalite->delete();
        return response(status: 204);
    }
}
