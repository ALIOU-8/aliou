<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de Recensement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .card {
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .h5, h4, .h4 {
            margin: 8px 0;
        }

        .text-success {
            color: #198754;
        }

        .text-center {
            text-align: center;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-md-4 {
            flex: 0 0 33.3333%;
            padding: 10px;
            box-sizing: border-box;
        }

        .border-dark {
            border: 2px solid #000;
        }

        .m-1 {
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #198754;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="h4 text-center text-success">FICHE DE RECENSEMENT</div>
            <div class="row">
                <div class="col-md-4">
                    <h4>N° Du Bâtiment : <span class="text-success">{{$recensement_cfu->bien->numero_bien}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Type : <span class="text-success">{{$recensement_cfu->type}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Statut : <span class="text-success">{{$recensement_cfu->statut}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Tel : <span class="text-success">{{$bien->contribuable->telephone}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Adresse : <span class="text-success">{{$bien->adresse}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Propriétaire : <span class="text-success">{{$bien->contribuable->nom .' '. $bien->contribuable->prenom}}</span></h4>
                </div>
            </div>

            <div class="row border-dark m-1">
                <div class="text-center h4 text-success" style="width: 100%;">Caractéristiques du bâtiment</div>
                <div class="col-md-4">
                    <h4>Nombre d'étage : <span class="text-success">{{$recensement_cfu->nbre_etage}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Surface : <span class="text-success">{{$recensement_cfu->surface}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Fondation : <span class="text-success">{{$recensement_cfu->nature_fondation}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Mur : <span class="text-success">{{$recensement_cfu->nature_mur}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Toit : <span class="text-success">{{$recensement_cfu->nature_toit}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Unité(s) : <span class="text-success">{{$recensement_cfu->nombre_unite}}</span></h4>
                </div>
                <div class="col-md-4">
                    <h4>Unités occupées : <span class="text-success">{{$recensement_cfu->nombre_unite_occuper}}</span></h4>
                </div>
            </div>

            <div class="h4 text-center text-success">Les Occupants du bâtiment</div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Occupant</th>
                            <th>Niveau</th>
                            <th>Unité</th>
                            <th>Activité</th>
                            <th>Valeur locative</th>
                            <th>Observation</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recensement_cfu->occupant as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$item->nom . ' ' . $item->prenom}}</td>
                            <td>{{$item->niveau}}</td>
                            <td>{{$item->unite}}</td>
                            <td>{{$item->activite}}</td>
                            <td>{{$item->valeur_locative}}</td>
                            <td>{{$item->observation}}</td>
                            <td>{{$item->type_occupant}}</td>
                        </tr>
                        @endforeach
                        @if(count($recensement_cfu->occupant) == 0)
                        <tr>
                            <td colspan="8">Aucun occupant trouvé pour ce bâtiment</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">Total</td>
                            <td colspan="3" class="text-center">{{$ValeurLocative." GNF"}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
