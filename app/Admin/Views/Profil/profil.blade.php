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
                            <img  src="{{asset('/storage/profil/'.$user->image)}}" class="img rounded-circle me-4" alt="">
                            <a href="" class="btn btn-outline-success me-4" data-bs-toggle="modal" data-bs-target="#nouveau">Changer de profil</a>
                            {{-- modal pour le profil --}}
                            <div class="modal fade" id="nouveau" tabindex="-1" aria-labelledby="nouveau" aria-hidden="true">
                                <div class="modal-dialog center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title"> <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>champ obligatoire maximum 5 Mo</span></div></h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="profilForm" action="{{ route('profil.change',$user->uuid) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="image">photo<span class="required-start text-danger text-bolder p-2">*</span></label>
                                                    <input type="file" id="image" name="image" class="form-control" placeholder="entrez votre photo">
                                                    <div id="photo_feedback" class="invalid-feedback">Numéro introuvable</div>
                                                    @error('image')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>                                                        
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Enregistrez<i class="bx bx-save"></i><i class="bx bx-check"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="{{route('profil.modif',$user->uuid)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="text-center h5">Informations Professionnelles</div>
                            <div class="row mt-4">
                                <div class="col-6 mb-3">
                                    <label for="nom">Nom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" name="nom" value="{{$user->nom}}" id="nom" class="form-control">
                                    @error('nom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="prenom">Prénom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" name="prenom" value="{{$user->prenom}}" id="prenom" class="form-control">
                                    @error('prenom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="email">Email<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" name="email" value="{{$user->email}}" id="email" class="form-control">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="telephone">Téléphone<span class="required-start text-danger text-bolder p-2">*</span></label>
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
                                    <label for="old_password">Ancien mot de passe<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="password" name="old_password" id="old_password" class="form-control">
                                    @error('old_password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password">Nouveau mot de passe<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password_confirmation">Confirmez mot de passe<span class="required-start text-danger text-bolder p-2">*</span></label>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#profilForm").on("submit", function (event) {
            let fileInput = $("#image")[0];
            let file = fileInput.files[0];
    
            if (!file) {
                event.preventDefault();
                $("#image").addClass("is-invalid");
                $("#photo_feedback").text("Veuillez sélectionner une image.").show();
                return;
            }
    
            let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                event.preventDefault();
                $("#image").addClass("is-invalid");
                $("#photo_feedback").text("Type de fichier non autorisé. Choisissez une image valide.").show();
                return;
            }
    
            if (file.size > 5 * 1024 * 1024) { // 5 Mo
                event.preventDefault();
                $("#image").addClass("is-invalid");
                $("#photo_feedback").text("L'image ne doit pas dépasser 5 Mo.").show();
                return;
            }
    
            // Si tout est bon
            $("#image").removeClass("is-invalid");
            $("#photo_feedback").hide();
        });
    });
    </script>
@endsection