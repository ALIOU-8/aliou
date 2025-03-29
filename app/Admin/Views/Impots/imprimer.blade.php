<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Avis d'Imposition - République de Guinée</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            font-size: 14px;
        }

        .container {
            width: 100%;
            padding: 0 10px;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card-body {
            padding: 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .document-title {
            font-size: 1.9rem;
            font-weight: bold;
            color: #2e7d32;
            text-align: center;
            margin: 10px 0;
        }

        .document-number {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .document-subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .tax-office-info {
            width: 40%;
        }

        .taxpayer-info {
            width: 58%;
            border: 1px solid #e0e0e0;
            padding: 12px;
            border-radius: 4px;
        }

        .payment-dates {
            width: 30%;
            margin-right: 2%;
        }

        .date-box {
            border: 1px solid #e0e0e0;
            padding: 8px;
            text-align: center;
            margin-bottom: 8px;
            border-radius: 4px;
        }

        .tax-details {
            width: 68%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-weight: 600;
        }

        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table tfoot td {
            font-weight: bold;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .text-success {
            color: #2e7d32;
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .warning-note {
            font-size: 0.85rem;
            color: #d32f2f;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- En-tête du document -->
                <div class="header-section">
                    <div class="text-uppercase">République de Guinée</div>
                    <div class="document-title">Avis d'imposition</div>
                </div>
                
                <!-- Numéro et sous-titre -->
                <div class="document-number">Numéro: <span class="text-success">{{ $impot->numero }}</span></div>
                <div class="document-subtitle">Impôts établis au profit de l'Etat</div>
                
                <!-- Section informations -->
                <div class="info-section">
                    <div class="tax-office-info">
                        <div class="text-uppercase">Direction nationale des impôts</div>
                        <div class="text-uppercase">Année <span>2025</span></div>
                        <div class="text-uppercase">Revenu de <span>2025</span></div>
                        <div>Article : <span class="me-3">{{$impot->article}}</span> Rôle : <span>{{$impot->role}}</span></div>
                        <div>Trésorerie : <span class="me-3">S.P.I/Mamou</span></div>
                    </div>
                    
                    <div class="taxpayer-info">
                        <div>Nom & Prénom : <span>{{$bien->contribuable->nom . ' ' .$bien->contribuable->prenom}}</span></div>
                        <div>Profession : <span>{{$bien->contribuable->profession}}</span></div>
                        <div>Adresse : <span>{{$bien->contribuable->telephone}}</span></div>
                        <div>Complète : <span>{{$bien->adresse}}</span></div>
                    </div>
                </div>
                
                <!-- Section détails de paiement -->
                <div style="display: flex; margin-top: 20px;">
                    <div class="payment-dates">
                        <div class="date-box">Date de mise en recouvrement</div>
                        <div class="date-box">Date limite de paiement</div>
                        <div class="date-box warning-note">
                            Au-delà de cette date, votre impôt sera majoré et des poursuites seront engagées contre vous
                        </div>
                    </div>
                    
                    <div class="tax-details">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @if($impot->type_impot != 'patente')
                                        <th>Nature d'impôt</th>
                                        <th>Base d'imposition</th>
                                        <th>Impôt Brut</th>
                                        <th>Imposition antérieure</th>
                                        <th>Pénalités</th>
                                        <th>Impôt à payer</th>
                                    @endif
                                    @if($impot->type_impot == 'patente')
                                        <th>Nature d'impôt</th>
                                        <th>Droit fixe</th>
                                        <th>Droit proportionnel</th>
                                        <th>Pénalités</th>
                                        <th>Impôt à payer</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($impot->type_impot != 'patente')
                                        <td class="text-uppercase">{{$impot->type_impot}}</td>
                                        <td>{{$impot->base_imposition}}</td>
                                        <td>{{$impot->montant_brute}}</td>
                                        <td>{{$impot->imposition_anterieur}}</td>
                                        <td>{{$impot->penalite}}</td>
                                        <td>{{$impot->montant_a_payer}}</td>
                                    @endif
                                    @if($impot->type_impot == 'patente')
                                        <td class="text-uppercase">{{$impot->type_impot}}</td>
                                        <td>{{$impot->droit_fixe}}</td>
                                        <td>{{$impot->droit_proportionnel}}</td>
                                        <td>{{$impot->penalite}}</td>
                                        <td>{{$impot->montant_a_payer}}</td>
                                    @endif
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="{{ $impot->type_impot != 'patente' ? 5 : 4 }}" class="text-end">Somme Total</td>
                                    <td>{{$impot->montant_a_payer}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>