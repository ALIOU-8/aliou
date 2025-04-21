@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('personnels.liste')}}">Personnels</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout personnel</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Ajout d'un personnel</div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>                        <form action="{{ route('personnels.store') }}" method="POST" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="matricule">Matricule<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="matricule" value="{{ old('matricule') }}">
                                    @error('matricule')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="nom" value="{{ old('nom') }}">
                                    @error('nom')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prénom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="prenom" value="{{ old('prenom') }}">
                                    @error('prenom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="telephone">Téléphone<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="telephone" value="{{ old('telephone') }}">
                                    @error('telephone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="fonction">Fonction<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="fonction" class="form-control" id="">
                                        <option value=""></option>
                                        @foreach ($fonction as $fonctions )
                                        <option  value="{{$fonctions->id}}">{{ $fonctions->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('fonction')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="hierachie">Hiérachie<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select name="hierachie" class="form-control" id="">
                                        <option  value=""></option>
                                        @foreach ($hierachie as $hierachies)
                                        <option  value="{{ $hierachies }}">{{  $hierachies }}</option>
                                        @endforeach
                                    </select>
                                    @error('hierachie')
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