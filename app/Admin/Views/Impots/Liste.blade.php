@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Impôts</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des Impôts</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1" data-bs-toggle="modal" data-bs-target="#nouveau">Nouveau<i class="bx bx-plus"></i></a>
                                {{-- Modal pour confirmer la suppression  --}}
                                <div class="modal fade" id="nouveau" aria-labelledby="nouveau" aria-hidden="true">
                                    <div class="modal-dialog center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="nouveau">Donnez le numéro du bien à imposer</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="num_bat">Numéro du bien</label>
                                                    <input type="text" class="form-control">
                                                    <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Vérifier <i class="bx bx-check"></i></button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('impot.imposition',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Imposer<i class="bx bx-money"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Type d'impôt</th>
                                        <th>Impôt brute</th>
                                        <th>Date limite</th>
                                        <th>Rôle</th>
                                        <th>Article</th>
                                        <th>Base d'imposition</th>
                                        <th>Imposition antérieure</th>
                                        <th>Pénalité</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Patente</td>
                                        <td>2.000.000</td>
                                        <td>25/06/2025</td>
                                        <td>30</td>
                                        <td>10</td>
                                        <td>Néant</td>
                                        <td>Néant</td>
                                        <td>Néant</td>
                                        <td class="text-success">Payé</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('impot.voir',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Voir<i class="bx bx-show"></i></a>
                                            <a href="{{route('impot.payer',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Payer<i class="bx bx-money"></i></a>
                                            <a href="{{route('impot.modif',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Licence</td>
                                        <td>2.000.000</td>
                                        <td>25/06/2025</td>
                                        <td>30</td>
                                        <td>10</td>
                                        <td>Néant</td>
                                        <td>Néant</td>
                                        <td>Néant</td>
                                        <td class="text-warning">Encours</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('impot.voir',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Voir<i class="bx bx-show"></i></a>
                                            <a href="{{route('impot.payer',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Payer<i class="bx bx-money"></i></a>
                                            <a href="{{route('impot.modif',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
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