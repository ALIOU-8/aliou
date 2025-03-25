@extends('Auth::layout')
@section('main')
<form action="{{route('auth.verification')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mb-4">
            <label for="email">Email</label>
            <input type="email" placeholder="Entrez votre email" class="form-control" name="email">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12">
            <button class="btn btn-success w-100">Vérifier</button>
        </div>
    </div>
</form>
@endsection