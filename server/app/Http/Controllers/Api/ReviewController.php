<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Parental;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Review::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Parental $parental, string $activiteId)
    {
        $activite = Activite::findOrFail($activiteId);
        $review = Review::create([
            ...$request->validate([
                'description' => 'required|string|max:1000',
                'rating' => 'required|integer|min:0|max:5'
            ]),
            'parental_id'=>$parental->id,
            'activite_id' => $activite->id
        ]);
        return $review;
    }

    /**
     * Display the specified resource.
     */
    public function show(Parental $parental, Activite $activite, Review $review)
    {
        return $review;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Parental $parental, Activite $activite, Review $review)
    {
        $review->update([
            ...$request->validate([
                'description' => 'sometimes|string|max:1000',
                'rating' => 'sometimes|integer|min:0|max:5'
            ])
        ]);
        return $review;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parental $parental,Activite $activite, Review $review)
    {
        
        $review->delete();
        return response(status: 204);
    }
}
