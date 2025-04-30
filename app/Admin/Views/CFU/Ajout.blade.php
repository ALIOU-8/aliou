@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout CFU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement CFU </div>
                        <div class="h6 mb-3 text-danger">
                            <span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obligatoires</span>
                        </div>
                        <form action="{{route('cfu.store')}}" method="POST" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="bien_id">Numero du bien<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" class="form-control" value="{{$bien_recence->numero_bien }}" disabled>
                                    <input type="hidden" name="bien_id" id="bien_id"  value="{{ $bien_recence->id }}">                  
                                </div> 
                                <div id="contribuable-info" class="col-md-6 d-block" style="">
                                    <div class="h6 mt-2">Informations du Proprietaire</div>
                                    <div class="h5 fw-bolder">Nom et Prénom : <span id="contribuable-name" class="fw-normal">{{ $bien_recence->contribuable->prenom.' '.$bien_recence->contribuable->nom  }}</span></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="annee_id">Année de recensement<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" class="text-success form-control" value="{{ $annee->annee }}" disabled>
                                    <input type="hidden" name="annee_id" id=""  value="{{ $annee->id }}"> 
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="statut">Statut<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="statut" class="form-control" id="">
                                        <option value=""></option>
                                        <option value="prive">Privé</option>
                                        <option value="etat_collectivite">Etat/Collectivité</option>
                                    </select>
                                    @error('statut')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type">Type<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="type" class="form-control" id="">
                                        <option value=""></option>
                                        <option value="personne_physique">Personne physique</option>
                                        <option value="personne_morale">Personne morale</option>
                                    </select>
                                    @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_rdv">Date du Rendez-vous<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" name="date_rdv">
                                    @error('date_rdv')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_recensement">Date Recensement<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" name="date_recensement">
                                    @error('date_recensement')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <hr>      
                                <div class="text-center h5 text-success">Caractéristiques du batiment</div>         
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nbre_etage">Nombre d'étage<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="number" name="nbre_etage">
                                    @error('nbre_etage')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="surface">Surface<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="surface">
                                    @error('surface')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nature_fondation">Nature fondation<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="nature_fondation" class="form-control" id="">
                                        <option value=""></option>
                                        <option value="legere">Légère</option>
                                        <option value="maconnee">Maçonnée</option>
                                    </select>
                                    @error('nature_fondation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nature_mur">Nature mur<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="nature_mur" class="form-control" id="">
                                        <option value=""></option>
                                        <option value="banco">Banco</option>
                                        <option value="dur">Dur</option>
                                    </select>
                                    @error('nature_mur')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nature_toit">Nature toit<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="nature_toit"  class="form-control" id="">
                                        <option value=""></option>
                                        <option value="vegetale">Végétale</option>
                                        <option value="tole">Tôle</option>
                                        <option value="dalle">Dalle</option>
                                    </select>
                                    @error('nature_toit')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nombre_unite">Nombre unité<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control"  type="number" name="nombre_unite">
                                @error('nombre_unite')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nombre_unite_occuper">Nombre unité Occupée<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="number" name="nombre_unite_occuper">
                                @error('nombre_unite_occuper')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>                
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">Enregistrer <i class="bx bx-save"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection