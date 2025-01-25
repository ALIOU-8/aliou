@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification CFU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement CFU </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="" class="form">
                            <div class="row">                               
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input class="form-control" type="text" name="nom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prénom</label>
                                    <input class="form-control" type="text" name="prenom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="adresse">Niveau</label>
                                    <input class="form-control" type="text" name="adresse">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="numBoutique">Unité</label>
                                    <input class="form-control" type="text" name="numBoutique">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Activité</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="numBoutique">Valeur locative</label>
                                    <input class="form-control" type="text" name="numBoutique">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">type d'occupant</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="numBoutique">Observation</label>
                                    <input class="form-control" type="text" name="numBoutique">
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