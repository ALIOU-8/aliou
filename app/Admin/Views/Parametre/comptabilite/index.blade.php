@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('parametre.index')}}">Paramètres</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Comptabilite</a></li>
    </ul>
    <div class="container">
        <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border shadow p-2">
                        <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bx-money"></i>Somme Total  Recouvrée</div>
                        <hr class="m-0">
                        <div class="h4 text-center mt-1 mb-1 p-3">
                           {{$sommeTotalRecouvrer ." GNF"}}                                    
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border shadow p-2">
                        <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bx-money"></i>Somme Total  Recensé</div>
                        <hr class="m-0">
                        <div class="h4 text-center mt-1 mb-1 p-3">
                           {{$sommeTotalRecenser ." GNF"}}                                    
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border shadow p-2">
                        <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bx-money"></i>Somme Non  Recouvrée</div>
                        <hr class="m-0">
                        <div class="h4 text-center mt-1 mb-1 p-3">
                           {{$sommeTotalRecenser - $sommeTotalRecouvrer  ." GNF"}}                                    
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="container">
        <div class="card border shadow">
            <div class="card-body">
                <div class="row">
                    <div class="h5 text-center text-success mt-3">Tableau matriciel</div>
                    <div class="row d-flex justify-content-between align-items-center me-1">
                        <div class="col-md-2">
                            <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Exporter <i class="bx bx-printer"></i></a>
                        </div>
                        <div class="col-md-4 ms-auto">
                            <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>N°</th>
                                    <th>N° Role</th>
                                    <th>N° Article</th>
                                    <th>Nom et Prénom</th>
                                    <th>Exercice</th>
                                    <th>Année</th>
                                    <th>Adresse</th>
                                    <th>IMF</th>
                                    <th>Pénalités</th>
                                    <th>Total à payer</th>
                                    <th>N° et date </th>
                                    <th>Observation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($impot as $key => $item)
                                @php
                                    $type = $item->type_impot;
                                    $recensement = "recensement_{$type}";
                                @endphp
                                @if(isset($item->$recensement))
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$item->role}}</td>
                                        <td>{{$item->article}}</td>
                                        <td>{{$item->$recensement->bien->contribuable->nom . ' ' . $item->$recensement->bien->contribuable->prenom }}</td>
                                        <td>{{ $item->$recensement->bien->contribuable->profession }}</td>
                                        <td>{{$item->annee->annee}}</td>
                                        <td>{{ $item->$recensement->bien->adresse }}</td>
                                        <td>{{ $item->type_impot }}</td>
                                        <td>{{ $item->penalite }}</td>
                                        <td>{{ $item->montant_a_payer }}</td>
                                        <td>{{ $item->numero }}</td>
                                        <td></td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="4">Total</td>
                                    <td class="text-center" colspan="1"></td>
                                    <td class="text-center" colspan="1"></td>
                                    <td class="text-center" colspan="1"></td>
                                    <td class="text-center" colspan="3">{{$sommeTotalRecenser." GNF"}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $impot->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>  
</main>
@endsection