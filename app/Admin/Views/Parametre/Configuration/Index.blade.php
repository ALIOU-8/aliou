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
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Type de bien</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration.type.biens')}}" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-1">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-cog"></i>Type d'impot</div>
                                    <hr class="m-0">
                                    <div class="mt-1 mb-1 p-3">
                                        <a href="{{route('parametre.configuration.type.impot')}}" class="btn btn-sm-lg btn-outline-success w-100">Configurer</a>
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
                            <div class="h5 text-center text-success mt-3">Tableau matricielle</div>
                            <div class="row d-flex justify-content-between align-items-center me-1">
                                <div class="col-md-2">
                                    <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                                </div>
                                <div class="col-md-4 ms-auto">
                                    <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>N° Role</th>
                                            <th>N° Article</th>
                                            <th>Nom et Prénom</th>
                                            <th>Exercice</th>
                                            <th>Adresse</th>
                                            <th>IMF</th>
                                            <th>Pénalités</th>
                                            <th>Total à payer</th>
                                            <th>N° et date </th>
                                            <th>Observation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td colspan="10"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td colspan="10"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td colspan="10"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td colspan="10"></td>
                                        </tr>
                                    </tbody>
                                    {{-- <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sano Ismael</td>
                                            <td>10/02/2025 à 12h:30min</td>
                                            <td>Contribuables</td>
                                            <td>Ajout</td>
                                        </tr>
                                    </tbody> --}}
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