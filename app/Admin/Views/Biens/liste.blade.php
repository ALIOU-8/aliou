@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Biens</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des biens</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a href="{{route('biens.ajout')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Nouveau <i class="bx bx-plus"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('biens.corbeille')}}" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Corbeille <i class="bx bx-tra"></i></a>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <input type="text" placeholder="Rechercher..." id="search" onkeyup="fetchBiens()" class="form-control border border-success m-3">
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
                                            <a href="{{route('biens.voir')}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Voir<i class="bx bx-show"></i></a>
                                            <a href="{{route('biens.modif',$biens->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer{{$biens->id}}">Supprimer<i class="bx bx-trash"></i></a>
                                            {{-- Modal pour confirmer la suppression  --}}
                                            <div class="modal fade" id="supprimer{{$biens->id}}" aria-labelledby="supprimer" aria-hidden="true">
                                                <div class="modal-dialog center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="supprimer">Voulez-vous supprimez ce bien ?</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">{{ $biens->contribuable->nom.' '.$biens->contribuable->prenom }}</div>
                                                            <div class="text-start">{{ $biens->typeBien->libelle }}</div>
                                                            <div class="text-start">{{ $biens->libelle }}</div>
                                                            <form action="{{route('biens.supprimer',$biens->id) }}" method="post">
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
                                    @endforeach
                                    @if (count($bien) == 0)
                                        <tr>
                                            <th colspan="6" class="text-center">Aucun enregistrement trouvé pour le moment</th>
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
function fetchBiens() {
    let query = document.getElementById("search").value;
    fetch("{{ route('biens.search') }}?query=" + query)
        .then(response => response.json())
        .then(data => {
            let tbody = document.querySelector("#biensTable tbody");
            tbody.innerHTML = "";

            if (data.length > 0) {
                data.forEach((bien, index) => {
                    let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${bien.contribuable ? bien.contribuable.nom + ' ' + bien.contribuable.prenom : 'N/A'}</td>
                            <td>${bien.type_bien ? bien.type_bien.libelle : 'N/A'}</td>
                            <td>${bien.numero_bien}</td>
                            <td>${bien.libelle}</td>
                            <td>${bien.adresse}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a class="btn btn-outline-success btn-sm d-flex align-items-center gap-1" href="#" data-bs-toggle="modal" data-bs-target="#voir${bien.id}">Voir<i class="bx bx-show"></i></a>

                                <a href="/biens/modif/${bien.id}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>

                                <a class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#supprimer${bien.id}">Supprimer<i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            } else {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center">Aucun bien trouvé</td></tr>`;
            }
        })
        .catch(error => console.error('Erreur:', error));
}
</script>
@endsection