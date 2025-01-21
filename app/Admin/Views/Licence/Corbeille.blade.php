@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('licence.liste')}}">Licence</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Corbeille licence</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Corbeille des licences</div>
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
                                        <th>Propriétaire</th>
                                        <th>Type</th>
                                        <th>N° boutique</th>
                                        <th>Libéllé</th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Sano Ismael</td>
                                        <td>Magasin</td>
                                        <td>5788</td>
                                        <td>Sano & Frères</td>
                                        <td>Telico en face de l'institut</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <form method="POST" action="">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Restaurer <i class="bx bx-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>   
                                    <tr>
                                        <th colspan="7" class="text-center">Aucun enregistrement trouvé pour le moment</th>
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