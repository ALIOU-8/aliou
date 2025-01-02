@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Personnels</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Ajout d'un personnel</div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="" class="form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="matricule">Matricule</label>
                                    <input class="form-control" type="text" name="matricule">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input class="form-control" type="text" name="nom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Prénom</label>
                                    <input class="form-control" type="text" name="nom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Téléphone</label>
                                    <input class="form-control" type="text" name="nom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Fonction</label>
                                    <input class="form-control" type="text" name="nom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="hierachie">Hiérachie</label>
                                    <input class="form-control" type="text" name="hierachie">
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