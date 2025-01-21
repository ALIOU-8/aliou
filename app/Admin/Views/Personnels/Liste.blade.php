@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Personnels</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des personnels</div>
                        <div class="row d-flex  align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('personnels.ajout')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Nouveau <i class="bx bx-plus"></i></a>
                            </div>
                            <div class="col-md-2 ">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('personnels.corbeille')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-trash"></i></a>
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
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>Fonction</th>
                                        <th>Hiérachie</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2204</td>
                                        <td>Sano</td>
                                        <td>Ismael</td>
                                        <td>628013477</td>
                                        <td>Etudiant</td>
                                        <td>A1</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('personnels.voir')}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#voir">Voir<i class="bx bx-show"></i></a>
                                            <div class="modal fade" id="voir" aria-labelledby="voir" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title text-center">Informations du personnel</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="h6 text-center">Direction Générale des Impôts de MAMOU</p>
                                                            <div class="h5 text-center">Carte de travail</div>
                                                            <div class="d-flex">
                                                                <img class="img me-3" src="{{asset('Admin/Assets/image1.jpg')}}" height="150px" alt="">
                                                                <div class="">
                                                                    <div class="h5"> Nom & Prénom : <small> Sano Ismael </small> </div>
                                                                    <div class="h5"> Matricule : <small> 2204 </small></div>
                                                                    <div class="h5"> Téléphone : <small> 628 01 34 77 </small> </div>
                                                                    <div class="h5"> Fonction : <small> Directeur Générale  </small></div>
                                                                    <div class="h5"> Hiérachie : <small> A1  </small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Imprimer <i class="bx bx-printer"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{route('personnels.modif')}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez ce personnel ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">Nom du personnel</div>
                                                            <div class="text-start">Prénom du personnel</div>
                                                            <button type="submit" class="btn btn-outline-danger btn-sm mt-2 d-flex align-items-center gap-1">Confirmer <i class="bx bx-check"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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