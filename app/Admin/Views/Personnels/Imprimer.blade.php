@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Personnels</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des personnels</div>
                        <div class="row d-flex  align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('personnels.ajout')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Nouveau <i class="bx bx-plus"></i></a>
                            </div>
                            <div class="col-md-2 ">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('personnels.corbeille')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-trash"></i></a>
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
                                            <a href="" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#voir{{$personnels->id}}">Voir<i class="bx bx-show"></i></a>
                                            <div class="modal fade" id="voir{{$personnels->id}}" aria-labelledby="voir" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title text-center">Informations du personnel</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="h6 text-center">Direction Générale des Impôts de MAMOU</p>
                                                            <div class="h5 text-center">Carte de travail</div>
                                                            <div class="d-flex">
                                                                <img class="img me-3" src="{{asset('Admin/Assets/image1.jpg')}}" height="150px" alt="">
                                                                <div class="">
                                                                    <div class="h5"> Nom & Prénom : <small> {{$personnels->nom.' '.$personnels->prenom }}</small> </div>
                                                                    <div class="h5"> Matricule : <small>{{ $personnels->matricule }}</small></div>
                                                                    <div class="h5"> Téléphone : <small>{{ $personnels->telephone }}</small> </div>
                                                                    <div class="h5"> Fonction : <small>{{ $personnels->fonction->libelle }}</small></div>
                                                                    <div class="h5"> Hiérachie : <small>{{ $personnels->hierachie }}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Imprimer <i class="bx bx-printer"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{route('personnels.modif',$personnels->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez ce personnel ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">{{ $personnels->nom }}</div>
                                                            <div class="text-start">{{ $personnels->prenom }}</div>
                                                            <form action="{{route('personnel.supprimer',$personnels->id) }}" method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2 d-flex align-items-center gap-1">Confirmer <i class="bx bx-check"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if (count($personnel) == 0)
                                        <th colspan="8" class="text-center">Aucun enregistrement trouvé pour le moment</th>
                                        @endif
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