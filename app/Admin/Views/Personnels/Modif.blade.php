@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('personnels.liste')}}">Personnels</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modifier personnel</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Modificatioin d'un personnel</div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{ route('personnels.update',$personnel->uuid)}}" method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="matricule">Matricule</label>
                                    <input class="form-control" type="text" name="matricule" value="{{$personnel->matricule}}">
                                    @error('matricule')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input class="form-control" type="text" name="nom" value="{{$personnel->nom}}">
                                    @error('nom')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prénom</label>
                                    <input class="form-control" type="text" name="prenom" value="{{$personnel->prenom}}">
                                    @error('prenom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="telephone">Téléphone</label>
                                    <input class="form-control" type="text" name="telephone" value="{{$personnel->telephone}}">
                                    @error('telephone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="fonction">Fonction</label>
                                    <select name="fonction" class="form-control" id="">
                                        <option selected value="{{$personnel->fonction_id}}">{{$personnel->fonction->libelle}}</option>
                                        @foreach ($fonction as $fonctions )
                                        @if($personnel->fonction->libelle != $fonctions->libelle )
                                        <option  value="{{$fonctions->id}}">{{ $fonctions->libelle}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('fonction')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="hierachie">Hiérachie</label>
                                    <select name="hierachie" class="form-control" id="">
                                        <option  selected value="{{$personnel->hierachie}}">{{$personnel->hierachie }}</option>
                                        @foreach ($hierachie as $hierachies)
                                        @if($personnel->hierachie !=$hierachies )
                                            <option  value="{{ $hierachies }}">{{  $hierachies }}</option> 
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('hierachie')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">Modifier <i class="bx bx-save"></i></button>
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