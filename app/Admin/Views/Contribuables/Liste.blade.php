@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Contribluable</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des contribuables</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('contribuables.ajout')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Nouveau <i class="bx bx-plus"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('contribuable.imprimer') }}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('contribuables.restaurer')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-trash"></i></a>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('contribuables.recherche') }}">
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
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>Profession</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contribuables as $key=>$contribuable)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $contribuable->nom }}</td>
                                        <td>{{ $contribuable->prenom }}</td>
                                        <td>{{ $contribuable->telephone }}</td>
                                        <td>{{ $contribuable->profession }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-success btn-sm d-flex align-items-center gap-1" href="" data-bs-toggle="modal" data-bs-target="#voir{{$contribuable->uuid}}">Voir<i class="bx bx-show"></i></a>
                                            {{-- Modal pour voir  --}}
                                            
                                            <div class="modal fade" id="voir{{$contribuable->uuid}}" aria-labelledby="voir" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="voir">Informations sur le contribuable <span class="text-danger text-uppercase">{{$contribuable->nom .' '. $contribuable->prenom}}</span></h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" >
                                                            @foreach ($contribuable->bien as $biens)
                                                                <div class="row">
                                                                    <div class="h6">Type de bien : {{ $biens->typeBien->libelle }}</div>
                                                                    <div class="h6">Numéro du bien : {{ $biens->numero_bien }}</div>
                                                                    <div class="h6">Nom du bien : {{ $biens->libelle }}</div>
                                                                </div>
                                                            @endforeach
                                                            <hr>
                                                            <div class="text-end">Total bien: {{ Count($contribuable->bien) }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <a href="{{route('contribuables.modif',$contribuable->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer{{$contribuable->uuid}}">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer{{$contribuable->uuid}}" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez ce Contribluable ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">{{ $contribuable->nom }}</div>
                                                            <div class="text-start">{{ $contribuable->prenom }}</div>
                                                            <a href="{{route('contribuables.supprime',$contribuable->uuid) }}" class="btn btn-outline-danger btn-sm mt-2 d-flex align-items-center gap-1">Confirmer <i class="bx bx-check"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (count($contribuables) == 0)
                                        <tr>
                                            <th colspan="6" class="text-center">Aucun enregistrement trouvé pour le moment</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $contribuables->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection