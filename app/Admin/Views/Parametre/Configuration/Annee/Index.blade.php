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
        <li><a href="" class="active">Année</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Année Recensement</div>
                        <form action="{{ isset($annee) ? route("parametre.configuration.annee.update",$annee->uuid) : route("parametre.configuration.annee.store") }}" method="post" class="form">
                            @csrf
                            @if(isset($annee))
                                @method('put')
                            @endif
                            <div class="row mt-4">
                                <div class="col-md-4 mb-3">
                                    <label for="annee">Année</label>
                                    <input class="form-control @error('annee') is-invalid @enderror" type="text" name="annee" value="{{ isset($annee) ? $annee->annee : old('annee') }}" placeholder="EX:2025">
                                    @error('annee')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_debut">Date Début</label>
                                    <input class="form-control @error('date_debut') is-invalid @enderror" type="Date" name="date_debut" value="{{ isset($annee) ? $annee->Date_debut : old('date_debut') }}" placeholder="la date debut du récensement">
                                    @error('date_debut')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date_fin">Date Fin</label>
                                    <input class="form-control @error('date_fin') is-invalid @enderror" type="Date" name="date_fin" value="{{ isset($annee) ? $annee->Date_fin : old('date_fin') }}" placeholder="la date fin du récensement">
                                    @error('date_fin')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>                               
                                <div class="col-md-6">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">{{ isset($annee) ? 'Modifier' : 'Enregistrer' }}<i class="bx bx-save"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('annee.recherche') }}">
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
                                        <th>Année</th>
                                        <th>Date Debut</th>
                                        <th>Date Fin</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($annees as $key=> $annee)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$annee->annee }}</td>
                                        <td>{{ $annee->Date_debut }}</td>
                                        <td>{{ $annee->Date_fin }}</td>
                                        <td>
                                            @if ($annee->active)
                                                <span style="color: green;">OUI</span>
                                            @else
                                                <span style="color: red;">NON</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-sm btn-primary" href="{{ route('parametre.configuration.annee.edit',$annee->uuid) }}">Modifier</a>
                                            @if (!$annee->active)
                                                <form action="{{ route('annees.activer', $annee->uuid) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success" type="submit">Activer</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                                              
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $annees->links('pagination::bootstrap-4') }}
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection