<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailEnfant;
use App\Models\Activite;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'age' => 'required|integer',
            'sex' => 'required|string',
            'domaine_prefere' => 'required|string',
            'matiere_prefere' => 'required|string',
        ]);

        DetailEnfant::create([
            'enfant_id' => $request->enfant_id,
            'age' => $request->age,
            'sex' => $request->sex,
            'domaine_prefere' => $request->domaine_prefere,
            'matiere_prefere' => $request->matiere_prefere,
        ]);

        return response()->json(['message' => 'Details submitted successfully'], 201);
    }

    public function recommend($enfantId)
    {
        $detailEnfant = DetailEnfant::where('enfant_id', $enfantId)->firstOrFail();

        // Logique de recommandation basée sur les détails de l'enfant
        $recommendedActivites = Activite::where(function($query) use ($detailEnfant) {
            if ($detailEnfant->age <= 10) {
                $query->whereIn('categorie', ['Arts and Crafts', 'Music and Dance', 'Storytelling and Drama']);
            } else {
                $query->whereIn('categorie', ['Sports', 'Science and Exploration', 'Outdoor Adventures']);
            }
            if ($detailEnfant->sex == 'female') {
                $query->orWhereIn('categorie', ['Cooking and Nutrition', 'Educational Enrichment']);
            } else {
                $query->orWhereIn('categorie', ['Mindfulness and Well-being', 'Programming and Coding']);
            }
            if (!empty($detailEnfant->domaine_prefere)) {
                $query->orWhere('categorie', $detailEnfant->domaine_prefere);
            }
            if (!empty($detailEnfant->matiere_prefere)) {
                $query->orWhere('categorie', $detailEnfant->matiere_prefere);
            }
        })->limit(5)->get();

        return response()->json($recommendedActivites);
    }
}
