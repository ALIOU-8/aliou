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
                            <div class="h5">Nom : <small> Sano</small> </div>
                            <div class="h5">Prénom : <small> Ismael</small> </div>
                            <div class="h5">Téléphone : <small> 628013477</small> </div>
                            <div class="h5">Profession : <small> Etudiant</small> </div>
                        </div>
                        <div class="">
                            <div class="h4 text-center">Informations du bien </div>
                            <div class="h5">Type de bien : <small> Magasin</small> </div>
                            <div class="h5">N° de la bien : <small> 5766</small> </div>
                            <div class="h5">Nom de la bien : <small> Sano & Frères</small> </div>
                            <div class="h5">Adresse de la bien : <small> Telico en face de l'institut</small> </div>
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