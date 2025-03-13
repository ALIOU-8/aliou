<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impression</title>
    <link rel="stylesheet" href="{{asset('Admin/Css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-4">
                <h6 class="text-uppercase text-center">Ministère du budget</h6>
                <hr>
                <h6 class="text-uppercase text-center">Inspection regionale des impots de Mamou</h6>
                <hr>
                <h6 class="text-uppercase text-center">Direction prefectorale des impots de Mamou</h6>
                <hr>
                <h6 class="text-uppercase text-center">N° ....../IRI/DPI/{{$annee->annee}}</h6>
            </div>
            <div class="col-4 offset-4">
                <h6 class="text-center">REPUBLIQUE DE GUINEE</h6>
                <hr>
                <h6 class="text-center">Travail-Justice-Solidarité</h6>
                <div class="d-flex justify-content-center">
                    <img src="{{asset('Admin/Assets/impot.jpg')}}" alt="">
                </div>
            </div>    
        </div>
    </div>
    <div class="container-fluid">
        <div class="text-center h4"> Situation du personnel </div>
            <div class="table-responsive">
                <table class="table table-bordered " id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th>N°</th>
                            <th>Nom et Prénom</th>
                            <th>Fonction</th>
                            <th>Matricule</th>
                            <th>Hiérachie</th>
                            <th>Téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnel as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->nom .' '. $item->prenom}}</td>
                            <td>{{ $item->fonction->libelle }}</td>
                            <td>{{ $item->matricule }}</td>
                            <td>{{ $item->hierachie }}</td>
                            <td>{{ $item->telephone }}</td>
                        </tr>
                        <tr>
                            @if (count($personnel) == 0)
                            <th colspan="6" class="text-center">Aucun enregistrement trouvé pour le moment</th>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-4 offset-8">
                <h6 class="text-center">Mamou, le 17 Février 2025</h6>
                <h6 class="text-center">Le Directeur</h6>
                <h6 class="text-center">LOUA Fassou</h6>
            </div>    
        </div>
    </div>
</body>
</html>