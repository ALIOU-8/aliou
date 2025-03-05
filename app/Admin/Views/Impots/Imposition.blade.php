@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('impot.liste')}}">Impôts</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout impôt</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Nouvelle Imposition </div>
                        {{-- <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div> --}}
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
                        <form action="{{route('impot.imposer',['type' => $type, 'id' => $recensement->id])}}" method="POST" class="form">
                            @csrf
                            <div class="row">
                                <hr>      
                                <div class="text-center h5 text-success">Imposition du bien</div>         
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="montant_brute">Montant Brute</label>
                                    <input class="form-control" type="text" name="montant_brute" value="{{old('montant_brute')}}">
                                    @error('montant_brute')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="montant_a_payer">Montant à payer</label>
                                    <input class="form-control" type="text" name="montant_a_payer" value="{{old('montant_a_payer')}}">
                                    @error('montant_a_payer')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_limite">Date limite</label>
                                    <input class="form-control" type="date" name="date_limite" value="{{old('date_limite')}}">
                                    @error('date_limite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="base_imposition">Base Imposition</label>
                                    <input class="form-control" type="text" name="base_imposition" value="{{old('base_imposition')}}">
                                    @error('base_imposition')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="imposition_anterieur">Imposition antérieure</label>
                                    <input class="form-control" type="text" name="imposition_anterieur" value="{{old('imposition_anterieur')}}">
                                    @error('imposition_anterieur')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="penalite">Pénalité</label>
                                    <input class="form-control" type="text" name="penalite" value="{{old('penalite')}}">
                                    @error('penalite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="droit_fixe">Droit fixe</label>
                                    <input class="form-control" type="text" name="droit_fixe" value="{{old('droit_fixe')}}">
                                    @error('droit_fixe')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="droit_proportionnel">Droit proportionnel</label>
                                    <input class="form-control" type="text" name="droit_proportionnel" value="{{old('droit_proportionnel')}}">
                                    @error('droit_proportionnel')
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