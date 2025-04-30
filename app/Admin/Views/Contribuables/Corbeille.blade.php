@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{ route('contribuables.liste') }}">Contribuable</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Corbeille</a></li>
    </ul>
    
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Corbeille des contribuables</div>
                        
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('contribuables.recherche.corbeille') }}">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control border border-success" placeholder="Rechercher..." value="{{ request('search') }}">
                                        <button class="btn btn-success" type="submit">Rechercher</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="contribuableTable">
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
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $contribuable->nom }}</td>
                                        <td>{{ $contribuable->prenom }}</td>
                                        <td>{{ $contribuable->telephone }}</td>
                                        <td>{{ $contribuable->profession }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <form method="POST" action="{{ route('contribuables.resto', $contribuable->uuid) }}">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Restaurer <i class="bx bx-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (count($contribuables) == 0)
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun enregistrement trouvé pour le moment</td>
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
