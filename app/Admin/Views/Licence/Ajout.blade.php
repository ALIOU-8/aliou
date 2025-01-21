@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('licence.liste')}}">Licence</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout Licence</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement Licence </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="" class="form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="id_cont">Propriétaire du bien</label>
                                    <select name="id_cont" id="id_cont" class="form-control">
                                        <option value=""></option>
                                        <option value="">628013477</option>
                                        <option value="">628013577</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="id_typeBien">Année de recensement</label>
                                    <select name="id_typeBien" id="id_typeBien" class="form-control">
                                        <option value="">Année en cours</option>
                                        <option value="">Année antérieure</option>
                                        <option value="">Année antérieure - 1</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Catégorie</label>
                                    <input class="form-control" type="text" name="libelle">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="adresse">Date du Rendez-vous</label>
                                    <input class="form-control" type="text" name="adresse">
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