@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('contribuables.liste')}}">Contribluable</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Contribluable</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Modificatioin d'un contribuable</div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>                        <form action="{{ route('contribuables.update',$contribuables->uuid) }}"  method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom
                                        <span class="required-start text-danger text-bolder p-2">*</span>
                                    </label>
                                    <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" value="{{ old('nom', $contribuables->nom) }}">
                                    @error('nom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prénom
                                        <span class="required-start text-danger text-bolder p-2">*</span>
                                    </label>
                                    <input class="form-control @error('prenom') is-invalid @enderror" type="text" name="prenom" value="{{ old('prenom', $contribuables->prenom) }}">
                                    @error('prenom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="telephone">Téléphone
                                        <span class="required-start text-danger text-bolder p-2">*</span>
                                    </label>
                                    <input class="form-control @error('telephone') is-invalid @enderror" type="text" name="telephone" value="{{ old('telephone', $contribuables->telephone) }}">
                                    @error('telephone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="profession">Profession
                                        <span class="required-start text-danger text-bolder p-2">*</span>
                                    </label>
                                    <input class="form-control @error('profession') is-invalid @enderror" type="text" name="profession" value="{{ old('profession', $contribuables->profession) }}">
                                    @error('profession')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">
                                        Validez la modification <i class="bx bx-save"></i>
                                    </button>
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