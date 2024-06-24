<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Activite;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class FactureController extends Controller
{
    public function generateFacture(Request $request)
    {
        $activite = Activite::find($request->activite_id);

        if (!$activite) {
            return response()->json(['message' => 'Activité not found'], 404);
        }

        $facture = Facture::create([
            'date_facture' => now(),
            'total_HT' => $request->total_HT,
            'total_TTC' => $request->total_TTC,
            'TVA' => $request->TVA,
            'activite_id' => $activite->id,
        ]);

        // Générer le contenu HTML en utilisant une vue Blade
        $html = View::make('facture_pdf', compact('facture', 'activite'))->render();

        // Créer un nouveau document PDF
        TCPDF::SetTitle('Facture');
        TCPDF::AddPage();
        TCPDF::writeHTML($html, true, false, true, false, '');

        $fileName = 'facture_' . $facture->id . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);

        // Sauvegarder le fichier PDF
        TCPDF::Output($filePath, 'F');

        // Vérifiez que le fichier a été enregistré
        if (file_exists($filePath)) {
            $facture->update(['facture_pdf' => $fileName]);
            return response()->json(['message' => 'Facture created and PDF generated successfully', 'facture' => $facture], 201);
        } else {
            return response()->json(['message' => 'Failed to generate PDF'], 500);
        }
    }


    public function downloadFacture($id)
    {
        $facture = Facture::findOrFail($id);
        $filePath = storage_path('app/public/' . $facture->facture_pdf);

        // Vérifiez que le fichier existe avant de le télécharger
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }
}

