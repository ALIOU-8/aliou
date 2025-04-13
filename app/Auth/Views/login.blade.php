@extends('Auth::layout')
@section('main')
<form action="{{route('login.store')}}" method="get">
    @csrf
    <div class="row">
        <div class="col-12 mb-4">
            <label for="matricule">Matricule</label>
            <input type="text" placeholder="Entrez votre matricule" class="form-control" name="matricule">
            @error('matricule')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="password">Mot de Passe</label>
            <input type="password" placeholder="Entrez votre mot de passe" class="form-control" name="password">
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <div class="text-end h6"><a href="{{route('auth.forget')}}">Mot de passe oublié ?</a></div>
        </div>
        <div class="col-12">
            <button class="btn btn-success w-100">Se connecter</button>
        </div>
    </div>
</form>
@endsection