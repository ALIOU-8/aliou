@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('personnels.liste')}}">Personnels</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Corbeille</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Corbeille des personnels</div>
                        <div class="row d-flex  align-items-center me-1">
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('personnel.recherche.corbeille') }}">
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
                                    @foreach ($personnel as $key=> $personnels)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $personnels->matricule }}</td>
                                        <td>{{ $personnels->nom }}</td>
                                        <td>{{ $personnels->prenom }}</td>
                                        <td>{{ $personnels->telephone }}</td>
                                        <td>{{ $personnels->fonction->libelle }}</td>
                                        <td>{{ $personnels->hierachie }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <form method="POST" action="{{ route('personnel.restor',$personnels->uuid) }}">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Restaurer <i class="bx bx-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        @if (count($personnel) == 0)
                                        <td colspan="8" class="text-center">Aucun enregistrement trouvé pour le moment</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $personnel->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection