<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impression</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; margin: 0 auto; }
        .header-table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: top; padding: 5px; }
        .header-table h6 { margin: 2px 0; text-align: center; font-size: 12px; }
        .img-container { text-align: center; }
        .img-container img { width: 80px; height: auto; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid black; padding: 5px; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <table class="header-table">
            <tr>
                <td style="width: 40%;">
                    <h6 class="text-uppercase">Ministère du budget</h6>
                    <hr>
                    <h6 class="text-uppercase">Inspection régionale des impôts de Mamou</h6>
                    <hr>
                    <h6 class="text-uppercase">Direction préfectorale des impôts de Mamou</h6>
                    <hr>
                    <h6 class="text-uppercase">N° ....../IRI/DPI/{{ $annee->annee }}</h6>
                </td>
                <td style="width: 20%;"></td>
                <td style="width: 40%;">
                    <h6>REPUBLIQUE DE GUINEE</h6>
                    <hr>
                    <h6>Travail-Justice-Solidarité</h6>
                    <div class="img-container">
                        <img src="{{ public_path('Admin/Assets/impot.jpg') }}" alt="Logo">
                    </div>
                </td>
            </tr>
        </table>

        <h4 style="text-align: center; margin-top: 10px;">Situation du personnel</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom et Prénom</th>
                    <th>Fonction</th>
                    <th>Matricule</th>
                    <th>Hiérarchie</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personnel as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nom . ' ' . $item->prenom }}</td>
                    <td>{{ $item->fonction->libelle }}</td>
                    <td>{{ $item->matricule }}</td>
                    <td>{{ $item->hierachie }}</td>
                    <td>{{ $item->telephone }}</td>
                </tr>
                @endforeach
                @if(count($personnel) == 0)
                <tr>
                    <td colspan="6" style="text-align: center;">Aucun enregistrement trouvé pour le moment</td>
                </tr>
                @endif
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: right;">
            <h6>Mamou, le 17 Février 2025</h6>
            <h6>Le Directeur</h6>
            <h6>LOUA Fassou</h6>
        </div>
    </div>
</body>
</html>
