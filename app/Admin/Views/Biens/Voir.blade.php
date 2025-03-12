@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('biens.liste')}}">Biens</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Voir bien</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                            <div class="h4 text-center">Informations du Propriétaire </div>
                            <div class="col-md-6 mb-3">
                                <h4>Nom</h4><span class="text-success h5">{{ $biens->contribuable->nom}}</span>
                            </div> 
                            <div class="col-md-6 mb-3">
                                <h4>Prénom</h4><span class="text-success h5">{{ $biens->contribuable->prenom}}</span>
                            </div> 
                            <div class="col-md-6 mb-3">
                                <h4>Téléphone</h4><span class="text-success h5">{{ $biens->contribuable->telephone}}</span>
                            </div> 
                            <div class="col-md-6 mb-3">
                                <h4>Profession</h4><span class="text-success h5">{{ $biens->contribuable->profession}}</span>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="h4 text-center">Informations du bien </div>
                            <div class="col-md-6 mb-3">
                                <h4>Type de bien : </h4><span class="text-success h5">{{ $biens->typeBien->libelle }}</span>
                            </div> 
                            <div class="col-md-6 mb-3">
                                <h4>N° {{ $biens->typeBien->libelle  }} :</h4><span class="text-success h5">{{ $biens->numero_bien }}</span>
                            </div> 
                            <div class="col-md-6 mb-3">
                                <h4>Nom {{ $biens->typeBien->libelle  }} :</h4><span class="text-success h5">{{ $biens->libelle }}</span>
                            </div> 
                            <div class="col-md-6 mb-3">
                                <h4>Adresse {{ $biens->typeBien->libelle  }} :</h4><span class="text-success h5">{{ $biens->adresse }}</span>
                            </div> 
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection