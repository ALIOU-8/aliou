@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('parametre.index')}}">Paramètre</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Configuration</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Configuration Interne</div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Invitation</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration.invitation')}}" class="btn btn-sm-lg btn-outline-success w-100">Inviter</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Type de bien</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration.type.biens')}}" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Fonction</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration.fonction')}}" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Année</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration.annee')}}" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="h5 text-center text-success">Historique de l'application</div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>Nom et Prénom</th>
                                            <th>Date et Heure</th>
                                            <th>Durée</th>
                                            <th>Activités</th>
                                            <th>Droit</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($historique as $key=> $historiques )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $historiques->user->nom.' '.$historiques->user->prenom }}</td>
                                            <td>{{ $historiques->date }}</td>
                                            <td class="text-success">{{ $historiques->updated_at->locale('fr')->diffForHumans() }}</td>
                                            <td>{{ $historiques->activite }}</td>
                                            <td>{{ $historiques->user->droit}}</td>
                                            <td>{{ $historiques->action }}</td>
                                        </tr>
                                        @endforeach
                                        
                                        @if(count($historique) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">Aucune historique trouvée</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $historique->links('pagination::bootstrap-4') }}
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