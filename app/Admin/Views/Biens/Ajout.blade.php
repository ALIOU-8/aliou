@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('biens.liste')}}">Biens</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Ajout Bien</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Ajout d'un bien</div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{route('biens.store')}}" method="post" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="contribuable_id">Propriétaire du bien</label>
                                    <select name="contribuable_id" id="contribuable_id" class="form-control">
                                        <option value=""></option>
                                        @foreach ($contribuable as $contribuables )
                                        <option value="{{ $contribuables->id }}">{{ $contribuables->telephone }}</option>
                                        @endforeach
                                    </select>
                                    @error('contribuable_id')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 d-block">
                                    <div class="h6 mt-2">Informations du client</div>
                                    <div class="h5 fw-bolder">Nom et Prénom : <span class="fw-normal">Sano Ismael</span></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type_bien_id">Type de bien</label>
                                    <select name="type_bien_id" id="type_bien_id" class="form-control">
                                        <option value=""></option>
                                        @foreach ($typeBien as $typeBiens )
                                            <option value="{{ $typeBiens->id }}">{{ $typeBiens->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_bien_id')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Libéllé</label>
                                    <input class="form-control" type="text" name="libelle" value="{{ old('libelle') }}">
                                    @error('libelle')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="adresse">Adresse</label>
                                    <input class="form-control" type="text" value="{{ old('adresse') }}" name="adresse">
                                    @error('adresse')
                                        <p class="text-danger">{{$message}}</p>
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