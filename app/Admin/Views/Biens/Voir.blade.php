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
                        <div class="">
                            <div class="d-flex justify-content-end">
                                <a href="" class="btn btn-outline-success">Imprimer</a>
                            </div>
                            <div class="h4 text-center">Informations du Propriétaire </div>
                            <div class="h5">Nom : <small> {{ $biens->contribuable->nom}}</small> </div>
                            <div class="h5">Prénom : <small> {{ $biens->contribuable->prenom }}</small> </div>
                            <div class="h5">Téléphone : <small> {{ $biens->contribuable->telephone }}</small> </div>
                            <div class="h5">Profession : <small> {{ $biens->contribuable->profession}}</small> </div>
                        </div>
                        <div class="">
                            <div class="h4 text-center">Informations du bien </div>
                            <div class="h5">Type de bien : <small>{{ $biens->typeBien->libelle }}</small> </div>
                            <div class="h5">N° {{ $biens->typeBien->libelle  }} : <small>{{ $biens->numero_bien }}</small> </div>
                            <div class="h5">Nom {{ $biens->typeBien->libelle  }} : <small>{{ $biens->libelle }}</small> </div>
                            <div class="h5">Adresse {{ $biens->typeBien->libelle  }} : <small>{{ $biens->adresse }}</small> </div>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-2 border border-6 border-dark mt-3 bg-dark" style="height: 130px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection