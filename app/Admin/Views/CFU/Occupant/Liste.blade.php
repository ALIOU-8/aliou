@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Occupant</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des Occupant du bâtiment " {{$nombatiment->libelle}} "</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('cfu.occupant.ajout',$batiment->id)}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Nouveau <i class="bx bx-plus"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('cfu.occupant.corbeille',$batiment->id)}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-trash"></i></a>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3" id="searchInput" onkeyup="searchTable()">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="myTable">
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
                                            <a href="{{route('cfu.occupant.modif',$item->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer{{$item->id}}">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer{{$item->id}}" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez cet occupant ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">{{$item->nom}}</div>
                                                            <div class="text-start">{{$item->prenom}}</div>
                                                            <div class="text-start">{{$item->activite}}</div>
                                                            <a href="{{ route('cfu.occupant.delete',$item->id) }}" class="btn btn-outline-danger btn-sm mt-2 d-flex align-items-center gap-1">Confirmer <i class="bx bx-check"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
<script>
    function searchTable() {
        // Récupère la valeur de la recherche
        let searchQuery = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("myTable");
        let rows = table.getElementsByTagName("tr");
        
        // Parcours chaque ligne du tableau (sauf l'en-tête)
        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName("td");
            let rowText = "";
            
            // Concatène le texte des cellules à rechercher
            for (let j = 0; j < cells.length - 1; j++) {  // Ne pas inclure la dernière colonne "Actions"
                rowText += cells[j].textContent.toLowerCase();
            }
            
            // Si le texte de la ligne correspond à la recherche, l'afficher, sinon la masquer
            if (rowText.includes(searchQuery)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>
@endsection