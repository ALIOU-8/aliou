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
                        <form action="{{route('profil.modif',$user->uuid)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="text-center h5">Informations Professionnelles</div>
                            <div class="row mt-4">
                                <div class="col-6 mb-3">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" value="{{$user->nom}}" id="nom" class="form-control">
                                    @error('nom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" value="{{$user->prenom}}" id="prenom" class="form-control">
                                    @error('prenom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{$user->email}}" id="email" class="form-control">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="telephone">Téléphone</label>
                                    <input type="text" name="telephone" value="{{$user->telephone}}" id="telephone" class="form-control">
                                    @error('telephone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3 mt-4">
                                    <button class="btn btn-outline-success">Modifier</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form action="{{route('profil.modif.mdp',$user->uuid)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="text-center h5">Informations Personnelles</div>
                            <div class="row mt-4">
                                <div class="col-6 mb-3">
                                    <label for="old_password">Ancien mot de passe</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control">
                                    @error('old_password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password">Nouveau mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password_confirmation">Confirmez mot de passe</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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