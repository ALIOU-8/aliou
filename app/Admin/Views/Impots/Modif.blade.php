@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('impot.liste')}}">Impôts</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification impôt</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Modification Imposition </div>
                        <div class="row mb-3">
                            <hr>
                            <fieldset class="row mb-3">
                                <legend class="h5">Information du propriétaire</legend>
                                <div class="col-md-4">
                                    <h5>Nom: {{$bien->contribuable->nom}} </h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Prénom: {{$bien->contribuable->prenom}} </h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Téléphone: {{$bien->contribuable->telephone}}</h5>
                                </div>
                            </fieldset>
                            <hr>
                            <fieldset class="row">
                                <legend class="h5">Informationn du bien</legend>
                                <div class="col-md-4">
                                    <h5>Numéro: {{$bien->numero_bien}}</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Type: {{$bien->typeBien->libelle}}</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Nom: {{$bien->libelle}}</h5>
                                </div>
                            </fieldset>
                        </div>
                        <form action="{{route('impot.update',$impot->uuid)}}" method="post" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <hr>      
                                <div class="text-center h5 text-success">Imposition du bien</div>         
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="montant_brute">Montant Brute<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="montant_brute" value="{{$impot->montant_brute}}">
                                    @error('montant_brute')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="montant_a_payer">Montant à payer<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="montant_a_payer" value="{{$impot->montant_a_payer}}">
                                    @error('montant_a_payer')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_limite">Date limite<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" name="date_limite" value="{{$impot->date_limite}}">
                                    @error('date_limite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="base_imposition">Base Imposition</label>
                                    <input class="form-control" type="text" name="base_imposition" value="{{$impot->base_imposition}}">
                                    @error('base_imposition')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="imposition_anterieur">Imposition antérieure</label>
                                    <input class="form-control" type="text" name="imposition_anterieur" value="{{$impot->imposition_anterieur}}">
                                    @error('imposition_anterieur')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="penalite">Pénalité</label>
                                    <input class="form-control" type="text" name="penalite" value="{{$impot->penalite}}">
                                    @error('penalite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if($impot->type_impot=='patente')
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="droit_fixe">Droit fixe<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="droit_fixe" value="{{$impot->droit_fixe}}">
                                    @error('droit_fixe')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="droit_proportionnel">Droit proportionnel<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="droit_proportionnel" value="{{$impot->droit_proportionnel}}">
                                    @error('droit_proportionnel')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endif              
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">Valider la modification <i class="bx bx-save"></i></button>
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