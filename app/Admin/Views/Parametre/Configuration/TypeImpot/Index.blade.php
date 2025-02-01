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
        <li><a href="" class="active">Type d'Impot</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="">
                            <div class="h5 mb-2 text-center text-success">Ajout d'un type d'impot</div>
                            <form action="{{ isset($type_impot) ? route("parametre.configuration.type.impot.update",$type_impot->id) : route("parametre.configuration.type.impot.store") }}" method="post" class="form">
                                @csrf
                                @if(isset($type_impot))
                                    @method('put')
                                @endif
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <input class="form-control" type="text" name="libelle" value="{{ isset($type_impot) ? $type_impot->libelle : old('libelle') }}" placeholder="Type d'impot">
                                        @error('libelle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                               
                                    <div class="col-md-6">
                                        <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">Enregistrer <i class="bx bx-save"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="h5 text-center text-success">La liste des types d'impot</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('parametre.configuration.type.impot.corbeille')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-tra"></i></a>
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
                                        <th>Libéllé</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($liste_type_impot as $key => $liste_type_impots)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$liste_type_impots->libelle}}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{Route('parametre.configuration.type.impot.edit',$liste_type_impots->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer{{$liste_type_impots->id}}">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer{{$liste_type_impots->id}}" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez ce type d'impot ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">{{$liste_type_impots->libelle}}</div>
                                                            <form method="POST" action="{{route('type_impot.supprimer',$liste_type_impots->id)}}">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2 d-flex align-items-center gap-1">Confirmer <i class="bx bx-check"></i></button>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
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