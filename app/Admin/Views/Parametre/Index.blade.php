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
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-success text-center mb-4">Paramètre de l'application</div>
                        <div class="row mb-3">
                            <div class="col-md-4 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bx-money"></i>Somme Total  Recouvrée</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center mt-1 mb-1 p-3">
                                        200 000 000 FG                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Gestion des utilisateurs</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="" class="btn btn-sm-lg btn-outline-success w-100">Ajouter</a>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-4 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Gestion Interne</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
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
                                            <th>Activités</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sano Ismael</td>
                                            <td>10/02/2025 à 12h:30min</td>
                                            <td>Contribuables</td>
                                            <td>Ajout</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection