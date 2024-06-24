<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Animateur;
use App\Models\Activite;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ImageUploadController extends Controller
{
    public function uploadEnfantImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $enfant = Enfant::findOrFail($id);

        // Store the image
        $path = $request->file('image')->store('public/enfants');

        // Update the 'photo' attribute with the new path
        $enfant->photo = $path;
        $enfant->save();

        return response()->json(['message' => 'Image uploaded successfully', 'path' => $path]);
    }

    public function uploadAnimateurImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $animateur = Animateur::findOrFail($id);

        // Store the image
        $path = $request->file('image')->store('public/animateurs');

        // Update the 'photo' attribute with the new path
        $animateur->photo = $path;
        $animateur->save();

        return response()->json(['message' => 'Image uploaded successfully', 'path' => $path]);
    }

    public function uploadActiviteImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $activite = Activite::findOrFail($id);

        // Store the image
        $path = $request->file('image')->store('public/activites');

        // Update the 'photo' attribute with the new path
        $activite->photo = $path;
        $activite->save();

        return response()->json(['message' => 'Image uploaded successfully', 'path' => $path]);
    }

    public function getEnfantImage($id)
    {
        $enfant = Enfant::findOrFail($id);
        $path = $enfant->photo;

        if (Storage::exists($path)) {
            return response()->download(storage_path('app/' . $path));
        }

        return response()->json(['message' => 'Image not found'], 404);
    }

    public function getAnimateurImage($id)
    {
        $animateur = Animateur::findOrFail($id);
        $path = $animateur->photo;

        if (Storage::exists($path)) {
            return response()->download(storage_path('app/' . $path));
        }

        return response()->json(['message' => 'Image not found'], 404);
    }

    public function getActiviteImage($id)
    {
        $activite = Activite::findOrFail($id);
        $path = $activite->photo;

        if (Storage::exists($path)) {
            return response()->download(storage_path('app/' . $path));
        }

        return response()->json(['message' => 'Image not found'], 404);
    }
}


