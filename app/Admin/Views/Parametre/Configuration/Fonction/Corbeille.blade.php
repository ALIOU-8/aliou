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
        <li><a href="{{route('parametre.configuration.fonction')}}">Fonction</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Corbeille</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Corbeille</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('fonction.recherche.corbeille') }}">
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
                                    @foreach ($fonction as $key=> $fonctions )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $fonctions->libelle }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <form method="POST" action="{{route('fonction.resto',$fonctions->uuid) }}">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Restaurer <i class="bx bx-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (count($fonction) == 0)
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun enregistrement trouvé pour le moment</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $fonction->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection