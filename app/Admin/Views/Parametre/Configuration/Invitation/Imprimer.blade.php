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
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <h4 style="text-align: center">lettre d'invitation</h4>
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
        <div style="margin-top: 20px; text-align: right;">
            <h6>Mamou, le {{ date('d:M:Y')}}</h6>
            <h6>Le Directeur</h6>
            <h6>LOUA Fassou</h6>
        </div>
    </div>
</body>
</html>
