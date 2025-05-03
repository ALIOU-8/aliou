@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Voir CFU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> FICHE DE RECENSEMENT </div>
                        <a href="{{ route('cfu.fiche.imprime',$recensement_cfu->uuid) }}" target="_blank" class="btn btn-outline-success">Imprimer <i class="bx bx-printer"></i></a>
                        {{-- <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div> --}}
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <h4>N° Du Bâtiment : <span class="text-success h5">{{$recensement_cfu->bien->numero_bien}}</span></h4>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <h4>Type : <span class="text-success h5">{{$recensement_cfu->type}}</span></h4>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <h4>Statut : <span class="text-success h5">{{$recensement_cfu->statut}}</span></h4>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <h4>Tel : <span class="text-success h5">{{$bien->contribuable->telephone }}</span></h4>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <h4>Adresse : <span class="text-success h5">{{$bien->adresse }}</span></h4>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <h4>Propriétaire du bien : <span class="text-success h5">{{$bien->contribuable->nom .' '. $bien->contribuable->prenom  }}</span></h4>
                                </div>
                                <div class="row border border-2 border-dark m-1">
                                    <div class="text-center h4 text-success">Caractéristiques du batiment</div>         
                                    <div class="col-md-4 mb-1">
                                        <h4>Nombre d'etage : <span class="text-success h5">{{$recensement_cfu->nbre_etage}}</span></h4>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <h4>Surface : <span class="text-success h5">{{$recensement_cfu->surface}}</span></h4>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <h4>Nature Fondation : <span class="text-success h5">{{$recensement_cfu->nature_fondation}}</span></h4>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <h4>Nature mur : <span class="text-success h5">{{$recensement_cfu->nature_mur}}</span></h4>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <h4>Nature toi : <span class="text-success h5">{{$recensement_cfu->nature_toit}}</span></h4>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <h4>Nombre d'unité : <span class="text-success h5">{{$recensement_cfu->nombre_unite}}</span></h4>
                                    </div>            
                                    <div class="col-md-4 mb-1">
                                        <h4>Nombre d'unité occupée : <span class="text-success h5">{{$recensement_cfu->nombre_unite_occuper}}</span></h4>
                                    </div>
                                </div> 
                                <div class="text-center h4 text-success">Les Occupants du batiment</div>         
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>N°</th>
                                                <th>Occupant</th>
                                                <th>Niveau</th>
                                                <th>Unité</th>
                                                <th>Activité</th>
                                                <th>Valeur locative</th>
                                                <th>Observation</th>
                                                <th>Type d'occupant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recensement_cfu->occupant as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{$item->nom . ' ' . $item->prenom}}</td>
                                                <td>{{$item->niveau}}</td>
                                                <td>{{$item->unite}}</td>
                                                <td>{{$item->activite}}</td>
                                                <td>{{$item->valeur_locative}}</td>
                                                <td>{{$item->observation}}</td>
                                                <td>{{$item->type_occupant}}</td>
                                            </tr>  
                                            @endforeach
                                            @if(count($recensement_cfu->occupant) == 0)
                                            <tr>
                                                <td colspan="10" class="text-center">Aucun occupant trouvé pour ce bâtiment</td>
                                             </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center" colspan="4">Total</td>
                                                <td class="text-center" colspan="1"></td>
                                                <td class="text-center" colspan="3">{{$ValeurLocative." GNF"}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div> 
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection