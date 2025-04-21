@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Paramètres</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-success text-center mb-4">Paramètre de l'application</div>
                        <div class="row mb-3">
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Comptabilité</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{ route('compatabilite.index') }}" class="btn btn-sm-lg btn-outline-success w-100">voir</a>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Gestion utilisateurs</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.user')}}" class="btn btn-sm-lg btn-outline-success w-100">Gerer</a>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Gestion Interne</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration')}}" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Gestion Site</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="#" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
                                    </div>
                                </div>
                            </div>
                                                     
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection