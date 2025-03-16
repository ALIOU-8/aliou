@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('parametre.index')}}">Paramètre</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Utilisateurs</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des utilisateurs</div>
                        <div class="row d-flex  align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('parametre.user.add')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Nouveau <i class="bx bx-plus"></i></a>
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
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Droit</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Utilisateur as $key => $item)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$item->matricule}} </td>
                                        <td> {{$item->nom}} </td>
                                        <td> {{$item->prenom}} </td>
                                        <td> {{$item->email}} </td>
                                        <td> {{$item->telephone}} </td>
                                        <td> {{$item->droit}} </td>
                                        <td class="@if($item->statut == 0) text-success @endif @if($item->statut == 1) text-danger @endif"> @if($item->statut == 0) Actif @endif @if($item->statut == 1) Bloqué @endif </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('parametre.user.modif',$item->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a href="{{route('parametre.user.bloquer',$item->id)}}" class="btn @if($item->statut == 0) btn-outline-danger @endif @if($item->statut == 1) btn-outline-success @endif btn-sm d-flex align-items-center gap-1"> @if($item->statut == 0) bloquer @endif @if($item->statut == 1) débloquer @endif <i class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
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