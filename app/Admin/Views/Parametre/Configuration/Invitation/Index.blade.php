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
        <li><a href="" class="active">Invitation</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des Biens</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-4 ms-auto">
                                <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3" id="searchInput" onkeyup="searchTable()">
                            </div>
                        </div>  
                        <div class="table-responsive">
                            <table id="biensTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Propriétaire</th>
                                        <th>Type</th>
                                        <th>N° Biens</th>
                                        <th>Libéllé</th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bien as $key=> $biens )
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $biens->contribuable->nom.' '.$biens->contribuable->prenom }}</td>
                                        <td>{{ $biens->typeBien->libelle}}</td>
                                        <td>{{ $biens->numero_bien }}</td>
                                        <td>{{ $biens->libelle}}</td>
                                        <td>{{ $biens->adresse }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('parametre.configuration.imprimer',$biens->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Imprimer<i class="bx bx-printer"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (count($bien) == 0)
                                        <tr>
                                            <th colspan="7" class="text-center">Aucun enregistrement trouvé pour le moment</th>
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