<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enfant;
use App\Models\EnfantInteret;
use App\Models\Service;
use Illuminate\Http\Request;

class EnfantInteretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Enfant $enfant)
    {
        return $enfant->interets;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Enfant $enfant)
    {
        $validatedData = $request->validate([
            'interet' => 'required|string'
        ]);
        $service = Service::where('service_name', $validatedData['interet'])
        ->firstOrFail();

        $interetenfant = EnfantInteret::create([
            'enfant_id' => $enfant->id,
            'service_id' =>  $service ->id,
        ]);
        return $interetenfant;
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
    public function destroy(Enfant $enfants, string $enfantinteretId)
    {
        $enfantinteret = EnfantInteret::findOrFail($enfantinteretId);
        $enfantinteret->delete();
        return response(status: 204);
    }
}
