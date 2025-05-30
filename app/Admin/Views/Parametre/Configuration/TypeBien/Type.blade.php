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
        <li><a href="" class="active">Type de biens</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="">
                            <div class="h5 mb-2 text-center text-success">Ajout d'un type de bien</div>
                            <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>champs obigatoire</span></div>
                            <form action="{{ isset($type_bien) ? route('parametre.configuration.type.bien.update',$type_bien->uuid) : route('parametre.configuration.type.bien.store') }}" method="POST" class="form">
                                @csrf
                                @if(isset($type_bien))
                                    @method('put')
                                @endif
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <input class="form-control" style="text-transform: uppercase" oninput="this.value=this.value.toUpperCase()" type="text" name="libelle" value="{{ isset($type_bien) ? $type_bien->libelle : old('libelle') }}" placeholder="Type de bien">
                                        @error('libelle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                               
                                    <div class="col-md-6">
                                        <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">{{ isset($type_bien) ? "Modifier" : "Enregistrer" }} <i class="bx bx-save"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="h5 text-center text-success">La liste des types de biens</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('parametre.configuration.type.biens.corbeille')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-tra"></i></a>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('type_bien.recherche') }}">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control border border-success" placeholder="Rechercher..." value="{{ request('search') }}">
                                        <button class="btn btn-success" type="submit">Rechercher</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Libéllé</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($liste_type_bien as $key => $liste_type_biens)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$liste_type_biens->libelle}}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{Route('parametre.configuration.type.bien.edit',$liste_type_biens->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer{{$liste_type_biens->id}}">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer{{$liste_type_biens->id}}" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez ce type de bien ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">{{$liste_type_biens->libelle}}</div>
                                                            <form method="POST" action="{{route('type_bien.supprimer',$liste_type_biens->uuid)}}">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2 d-flex align-items-center gap-1">Confirmer <i class="bx bx-check"></i></button>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (count($liste_type_bien) == 0)
                                        <tr>
                                            <th colspan="6" class="text-center">Aucun enregistrement trouvé pour le moment</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $liste_type_bien->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection