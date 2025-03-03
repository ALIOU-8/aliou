@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.occupant.liste',$batiment->id)}}">Occupant</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Corbeille</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">Corbeille du batiment " {{$nombatiment->libelle}} "</div>
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
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Niveau</th>
                                        <th>Unité</th>
                                        <th>Activité</th>
                                        <th>Valeur locative</th>
                                        <th>Observation</th>
                                        <th>Type d'occupant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($occupant as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$item->nom}}</td>
                                        <td>{{$item->prenom}}</td>
                                        <td>{{$item->niveau}}</td>
                                        <td>{{$item->unite}}</td>
                                        <td>{{$item->activite}}</td>
                                        <td>{{$item->valeur_locative}}</td>
                                        <td>{{$item->observation}}</td>
                                        <td>{{$item->type_occupant}}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <form method="POST" action="{{route('cfu.occupant.restaure',$item->id)}}">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Restaurer <i class="bx bx-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>  
                                    @endforeach
                                    @if(count($occupant) == 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Aucun occupant trouvé pour ce bâtiment</td>
                                     </tr>
                                    @endif
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