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
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-2">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-4">
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
                                    <tr>
                                        <td>2</td>
                                        <td>2204</td>
                                        <td>Bah</td>
                                        <td>Mamadou Saliou</td>
                                        <td>620394850</td>
                                        <td>Etudiant</td>
                                        <td>A1</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">Supprimer<i class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2204</td>
                                        <td>Mansaré</td>
                                        <td>François Tatoulou</td>
                                        <td>620202081</td>
                                        <td>Etudiant</td>
                                        <td>A1</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">Supprimer<i class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2204</td>
                                        <td>Diallo</td>
                                        <td>Mamadou Lamarana</td>
                                        <td>628783477</td>
                                        <td>Etudiant</td>
                                        <td>A1</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">Supprimer<i class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>2204</td>
                                        <td>Diallo</td>
                                        <td>Mamadou Aliou</td>
                                        <td>620394850</td>
                                        <td>Etudiant</td>
                                        <td>A1</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">Supprimer<i class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>2204</td>
                                        <td>Barry</td>
                                        <td>Alpha Ibrahim</td>
                                        <td>620202081</td>
                                        <td>Etudiant</td>
                                        <td>A1</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a href="" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">Supprimer<i class="bx bx-trash"></i></a>
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