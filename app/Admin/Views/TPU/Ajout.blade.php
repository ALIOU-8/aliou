@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('tpu.liste')}}">TPU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout TPU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement TPU </div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>                        <form action="{{ route("tpu.store") }}" method="POST" class="form">
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
                                    <label class="form-label" for="categorie">Catégorie<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="categorie">
                                    @error('categorie')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="Date_rdv">Date du Rendez-vous<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" name="Date_rdv">
                                    @error('Date_rdv')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>   
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="Date_recensement">Date de Rencensement<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" name="Date_recensement">
                                    @error('Date_recensement')
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