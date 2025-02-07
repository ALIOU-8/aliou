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
                        <div class="h5 text-center text-success">Année</div>
                        <form action="{{ isset($annee) ? route("parametre.configuration.annee.update",$annee->id) : route("parametre.configuration.annee.store") }}" method="post" class="form">
                            @csrf
                            @if(isset($annee))
                                @method('put')
                            @endif
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <input class="form-control @error('annee') is-invalid @enderror" type="text" name="annee" value="{{ isset($annee) ? $annee->annee : old('annee') }}" placeholder="EX:2025">
                                    @error('annee')
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
                                <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3" id="searchInput" onkeyup="searchTable()">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Année</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($annees as $key=> $annee)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$annee->annee }}</td>
                                        <td>
                                            @if ($annee->active)
                                                <span style="color: green;">OUI</span>
                                            @else
                                                <span style="color: red;">NON</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-sm btn-primary" href="{{ route('parametre.configuration.annee.edit',$annee->id) }}">Modifier</a>
                                            @if (!$annee->active)
                                                <form action="{{ route('annees.activer', $annee->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success" type="submit">Activer</button>
                                                </form>
                                            @endif
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