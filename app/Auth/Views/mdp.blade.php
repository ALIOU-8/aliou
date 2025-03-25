@extends('Auth::layout')
@section('main')
<form action="{{route('auth.mdp-update')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password">
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label class="form-label" for="hierachie">Confirmer mot de passe</label>
            <input class="form-control" type="password" name="password_confirmation">
            @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12">
            <button class="btn btn-success w-100">Changer</button>
        </div>
    </div>
</form>
@endsection