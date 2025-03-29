@extends('Auth::layout')
@section('main')
<form action="{{route('auth.otp.verification')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mb-4">
            <label for="otp">Code de vérification</label>
            <input type="text" placeholder="Entrez votre otp" class="form-control" name="otp">
            @error('otp')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12">
            <button class="btn btn-success w-100">Vérifier</button>
        </div>
    </div>
</form>
@endsection