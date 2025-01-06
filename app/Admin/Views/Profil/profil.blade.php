@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Profil</a></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="carte">
                    <a href="" class="active"><i class="bx bxs-user me-2 fs-6"></i>Profil</a>
                    <a href=""><i class="bx bxs-chat me-2 fs-6"></i>Message</a>
                    <a href=""><i class="bx bxs-bell me-2 fs-6"></i>Notification</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border shadow mb-5">
                    <div class="card-body border sahadow">
                        <div class="header">
                            <img src="{{asset('Admin/Assets/image1.jpg')}}" class="img rounded-circle me-4" alt="">
                            <a href="" class="btn btn-outline-success me-4">Changer de profil</a>
                            <a href="" class="btn btn-outline-success">Supprimer profil</a>
                        </div>
                        <hr>
                        <form action="">
                            <div class="text-center h5">Informations Professionnelles</div>
                            <div class="row mt-4">
                                <div class="col-6 mb-3">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="telephone">Téléphone</label>
                                    <input type="text" name="telephone" id="telephone" class="form-control">
                                </div>
                                <div class="col-6 mb-3 mt-4">
                                    <button class="btn btn-outline-success">Modifier</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form action="">
                            <div class="text-center h5">Informations Personnelles</div>
                            <div class="row mt-4">
                                <div class="col-6 mb-3">
                                    <label for="oldpassword">Ancien mot de passe</label>
                                    <input type="password" name="oldpassword" id="oldpassword" class="form-control">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password">Nouveau mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="confirmation_password">Confirmez mot de passe</label>
                                    <input type="password" name="confirmation_password" id="confirmation_password" class="form-control">
                                </div>
                                <div class="col-6 mb-3 mt-4">
                                    <button class="btn btn-outline-success">Modifier</button>
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