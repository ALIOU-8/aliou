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
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <div class="row mb-3">
                            <hr>
                            <fieldset class="row mb-3">
                                <legend class="h5">Informationn du propriétaire</legend>
                                <div class="col-md-4">
                                    <h5>Nom: Sano</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Prénom: Ismael</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Téléphone: 628 01 34 77</h5>
                                </div>
                            </fieldset>
                            <hr>
                            <fieldset class="row">
                                <legend class="h5">Informationn du bien</legend>
                                <div class="col-md-4">
                                    <h5>Numéro: Btq001</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Type: Boutique</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Nom: Sano & Frères</h5>
                                </div>
                            </fieldset>
                        </div>
                        <form action="" class="form">
                            <div class="row">
                                <hr>      
                                <div class="text-center h5 text-success">Imposition du bien</div>         
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="numBoutique">Montant Brute</label>
                                    <input class="form-control" type="text" name="numBoutique">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Montant à payer</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="numBoutique">Date limite</label>
                                    <input class="form-control" type="text" name="numBoutique">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Base Imposition</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="numBoutique">Imposition antérieure</label>
                                    <input class="form-control" type="text" name="numBoutique">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Pénalité</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Droit fixe</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Droit proportionnel</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>                
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