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
            <div class="col-6">
                <h6 class="text-uppercase text-center">Ministère du budget</h6>
                <hr>
                <h6 class="text-uppercase text-center">Direction generale des impots</h6>
                <hr>
                <h6 class="text-uppercase text-center">Inspection regionale des impots de Mamou</h6>
                <hr>
                <h6 class="text-uppercase text-center">Direction prefectorale des impots de Mamou</h6>
                <hr>
                <h6 class="text-uppercase text-center">Tel : </h6>
                <hr>
                <h6 class="text-uppercase text-center">N° ....../IRI/DPI</h6>
            </div>
            <div class="col-4 offset-2">
                <h6 class="text-center">REPUBLIQUE DE GUINEE</h6>
                <hr>
                <h6 class="text-center">Travail-Justice-Solidarité</h6>
                <div class="d-flex justify-content-center">
                    <img src="{{asset('Admin/Assets/impot.jpg')}}" alt="">
                </div>
            </div> 
            <div class="col-12">
                <h4 class="text-center text-uppercase">lettre d'invitation</h4>
                <p>
                    Mr/Mme {{$invitation->nom . ' ' . $invitation->prenom}}  ..........................................................................................................................................
                    <br>
                    <br>
                    est prié de se présenter à la direction préfectorale des impots de Mamou sise en face de la station Total de poudrière le {{$invitation->date_rdv}} à partir de 10 heures précises.
                    <br>
                    Motif : {{$invitation->motif}} ..........................................................................................................................................
                    <br>
                    Se munir : {{$invitation->se_munir}}  ..........................................................................................................................................
                    <br>
                    Veuillez recevoir, Mr/Mme, l'expression de mes sentiments distingués.
                </p>
            </div>   
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-4 offset-8">
                <h6 class="text-center">Mamou, le 17 Février 2025</h6>
                <h6 class="text-center">Le Directeur</h6>
                <br>
                <br>
                <h6 class="text-center">LOUA Fassou</h6>
            </div>    
        </div>
    </div>
</body>
</html>