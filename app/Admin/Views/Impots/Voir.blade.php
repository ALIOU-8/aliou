@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('impot.liste')}}">Impôts</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Voir impôt</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="h6 text-uppercase">République de Guinée</div>
                            <div class="h4 mb-2 text-center text-success"> Avis d'imposition </div>
                            <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                        </div>
                        <div class="h6 mb-3 text-center">Impots établis au profit de l'Etat</div>
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column align-items-center gap-1">
                                <div class="h6 text-uppercase">direction nationale des impots</div>
                                <div class="h6 text-uppercase">Année <span>2025</span></div>
                                <div class="h6 text-uppercase">Revenue de  <span>2025</span></div>
                                <div class="h6">Article : <span class="me-3">{{$impot->article}}</span> Role : <span>{{$impot->role}}</span></div>   
                                <div class="h6">Trésorerie : <span class="me-3">S.P.I/Mamouu</span> </div>   
                            </div>
                            <div class="col-md-8 border p-3">
                                <div class="h6 ">Nom & Prénom : <span>{{$bien->contribuable->nom . ' ' .$bien->contribuable->prenom}}</span></div>
                                <div class="h6 ">Profession : <span>{{$bien->contribuable->profession}}</span></div>
                                <div class="h6 ">Adresse : <span> {{$bien->contribuable->telephone}} </span></div>
                                <div class="h6 ">Complète : <span> {{$bien->adresse}} </span></div>
                            </div>
                        </div>
                        <div class="row mt-3">    
                            <div class="col-md-3">
                                <div class="border text-center p-1">
                                    Date de mise en recouvrement
                                </div>
                                <div class="border text-center p-1">
                                    Date limite de paiement
                                </div>
                                <div class="border text-center p-2">
                                    Au delà de cette date, votre impôt sera majoré et des poursuites seront engagés contre vous
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Nature d'impôt</th>
                                            <th>Base d'imposition</th>
                                            <th>Impôt Brut</th>
                                            <th>Imposition antérieure</th>
                                            <th>Pénalités</th>
                                            <th>Impot à payer</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-uppercase">{{$impot->type_impot}}</td>
                                                <td>{{$impot->base_imposition}}</td>
                                                <td>{{$impot->montant_brute}}</td>
                                                <td>{{$impot->imposition_anterieur}}</td>
                                                <td>{{$impot->penalite}}</td>
                                                <td>{{$impot->montant_a_payer}}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-end h5">Somme Total</td>
                                                <td>{{$impot->montant_a_payer}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 mb-3"><h6>Nature d'impot : <span>Tpu</span></h6></div>                         
                            <div class="col-md-4 mb-3"><h6>Base d'imposition : <span>Néant</span></h6></div>                         
                            <div class="col-md-4 mb-3"><h6>Impot Brut : <span>1000000</span></h6></div>                         
                            <div class="col-md-4 mb-3"><h6>Imposition antérieure : <span>1000000</span></h6></div>                         
                            <div class="col-md-4 mb-3"><h6>Pénalité : <span>Néant</span></h6></div>                         
                            <div class="col-md-4 mb-3"><h6>Impot à payer : <span>1000000</span></h6></div>                         
                            <div class="col-md-4 mb-3"><h6>Total : <span>1000000</span></h6></div>                          --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection