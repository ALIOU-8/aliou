@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.occupant.liste',$cfu->uuid)}}">Occupant</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout Occupant</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Ajout d'un occupant pour le bâtiment " {{$nombatiment->libelle}} "</div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{route('cfu.occupant.store',$cfu->uuid)}}" class="form">
                            @csrf
                            <div class="row">                               
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input class="form-control" type="text" value="{{old('nom')}}" name="nom">
                                    @error('nom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prénom</label>
                                    <input class="form-control" type="text" value="{{old('prenom')}}" name="prenom">
                                    @error('prenom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="niveau">Niveau</label>
                                    <input class="form-control" type="text" value="{{old('niveau')}}" name="niveau">
                                    @error('niveau')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="unite">Unité</label>
                                    <input class="form-control" type="text" value="{{old('unite')}}" name="unite">
                                    @error('unite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="activite">Activité</label>
                                    <input class="form-control" type="text" value="{{old('activite')}}" name="activite">
                                    @error('activite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="valeur_locative">Valeur locative</label>
                                    <input class="form-control" type="text" value="{{old('valeur_locative')}}" name="valeur_locative">
                                    @error('valeur_locative')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type_occupant">type d'occupant</label>
                                    <input class="form-control" type="text" value="{{old('type_occupant')}}" name="type_occupant">
                                    @error('type_occupant')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="observation">Observation</label>
                                    <input class="form-control" type="text" value="{{old('observation')}}" name="observation">
                                    @error('observation')
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