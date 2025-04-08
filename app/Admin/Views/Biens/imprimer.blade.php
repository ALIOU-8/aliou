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

        <h4 style="text-align: center; margin-top: 10px;">Liste des biens</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Propriétaire</th>
                    <th>Type</th>
                    <th>N° Biens</th>
                    <th>Libéllé</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bien as $key=> $biens )
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td>{{ $biens->contribuable->nom.' '.$biens->contribuable->prenom }}</td>
                        <td>{{ $biens->typeBien->libelle}}</td>
                        <td>{{ $biens->numero_bien }}</td>
                        <td>{{ $biens->libelle}}</td>
                        <td>{{ $biens->adresse }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: right;">
            <h6>Mamou, le {{ date('d:M:Y')}}</h6>
        </div>
    </div>
</body>
</html>
