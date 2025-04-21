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
        <li><a href="" class="active">Modification CFU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Modification Occupant </div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>
                        <form action="{{route('cfu.occupant.update',$occupant->uuid)}}" class="form">
                            @csrf
                            @method('put')
                            <div class="row">                               
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->nom}}" name="nom">
                                    @error('nom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prénom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->prenom}}" name="prenom">
                                    @error('prenom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="niveau">Niveau<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->niveau}}" name="niveau">
                                    @error('niveau')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="unite">Unité<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->unite}}" name="unite">
                                    @error('unite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="activite">Activité<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->activite}}" name="activite">
                                    @error('activite')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="valeur_locative">Valeur locative<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->valeur_locative}}" name="valeur_locative">
                                    @error('valeur_locative')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type_occupant">type d'occupant<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->type_occupant}}" name="type_occupant">
                                    @error('type_occupant')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="observation">Observation<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{$occupant->observation}}" name="observation">
                                    @error('observation')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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