@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('parametre.index')}}">Paramètre</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('parametre.configuration')}}">Configuration</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Recensement Annuel</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Recensement Annuel</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            
                            <div class="col-md-4 ms-auto">
                                <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Libéllé</th>
                                        <th>Activer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2025</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Oui<i class="bx bx-check"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2025</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('biens.modif')}}" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">Non<i class="bx bx-check"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection