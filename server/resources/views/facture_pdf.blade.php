<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facture PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
        }
        .content {
            margin: 20px;
        }
        .details, .activite-details {
            margin-bottom: 20px;
        }
        .details table, .activite-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details table th, .details table td, .activite-details table th, .activite-details table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .details table th, .activite-details table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Facture</h1>
    </div>
    <div class="content">
        <div class="details">
            <h2>Détails de la Facture</h2>
            <table>
                <tr>
                    <th>Date de Facture</th>
                    <td>{{ $facture->date_facture }}</td>
                </tr>
                <tr>
                    <th>Total HT</th>
                    <td>{{ $facture->total_HT }}</td>
                </tr>
                <tr>
                    <th>Total TTC</th>
                    <td>{{ $facture->total_TTC }}</td>
                </tr>
                <tr>
                    <th>TVA</th>
                    <td>{{ $facture->TVA }}</td>
                </tr>
            </table>
        </div>
        <div class="activite-details">
            <h2>Détails de l'Activité</h2>
            <table>
                <tr>
                    <th>ID de l'Activité</th>
                    <td>{{ $activite->id }}</td>
                </tr>
                <tr>
                    <th>Titre</th>
                    <td>{{ $activite->titre }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $activite->description }}</td>
                </tr>
                <tr>
                    <th>Âge Minimum</th>
                    <td>{{ $activite->age_min }}</td>
                </tr>
                <tr>
                    <th>Âge Maximum</th>
                    <td>{{ $activite->age_max }}</td>
                </tr>
                <tr>
                    <th>Type d'Activité</th>
                    <td>{{ $activite->type_activite }}</td>
                </tr>
                <tr>
                    <th>Effectif Minimum</th>
                    <td>{{ $activite->eff_min }}</td>
                </tr>
                <tr>
                    <th>Effectif Maximum</th>
                    <td>{{ $activite->eff_max }}</td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td>{{ $activite->nom }}</td>
                </tr>
                <tr>
                    <th>Catégorie</th>
                    <td>{{ $activite->categorie }}</td>
                </tr>
                <tr>
                    <th>Mode de Réalisation</th>
                    <td>{{ $activite->mode_de_realisation }}</td>
                </tr>
                <tr>
                    <th>Nombre de Séances</th>
                    <td>{{ $activite->nbre_seance }}</td>
                </tr>
                <tr>
                    <th>Prix</th>
                    <td>{{ $activite->prix }}</td>
                </tr>
            </table>
        </div>
        <div class="total">
            <p>Total à payer: {{ $facture->total_TTC }} €</p>
        </div>
    </div>
    <div class="footer">
        <p>Merci pour votre confiance.</p>
    </div>
</body>
</html>
