@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Impôts</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Historique de Paiement </div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1" data-bs-toggle="modal" data-bs-target="#nouveau">Nouveau<i class="bx bx-plus"></i></a>
                                {{-- Modal pour confirmer le numero du bien  --}}
                                <div class="modal fade" id="nouveau" aria-labelledby="nouveau" aria-hidden="true">
                                    <div class="modal-dialog center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="nouveau">Donnez le numéro du bien à imposer</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="numeroForm" action="{{ route('impots.numero') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <label for="numero">Numéro</label>
                                                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Saisir le numéro">
                                                            <div id="numero_feedback" class="invalid-feedback">Numéro introuvable</div>
                                                            @error('numero')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                    </div>                                                        
                                                    <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Imposer<i class="bx bx-money"></i><i class="bx bx-check"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <input type="text" placeholder="Rechercher..." class="form-control border border-success m-3" id="searchImpots" onkeyup="fetchImpots()">
                            </div>
                        </div>
                        <div class="historique_de_paiement">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Date</th>
                                            <th>Montant Total</th>
                                            <th>Montant Payer</th>
                                            <th>Montant Restant</th>
                                            <th>N° de quitance</th>
                                            {{-- <th>Personnel</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paiement as $key => $item)
                                        @php
                                            $type = $item->impot->type_impot;
                                            $recensement = "recensement_{$type}";
                                        @endphp

                                        @if(isset($item->impot->$recensement))
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->impot->$recensement->bien->contribuable->nom }}</td>
                                                <td>{{ $item->impot->$recensement->bien->contribuable->prenom }}</td>
                                                <td>{{ $item->created_at }}</td> 
                                                <td>{{ $item->impot->montant_a_payer }}</td>
                                                <td>{{ $item->montant_payer }}</td>
                                                <td>{{ $item->montant_restant }}</td> 
                                                <td>{{ $item->num_quitance }}</td>
                                                <td class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('impot.payer', $item->impot->$recensement->id) }}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">
                                                        Détail<i class="bx bx-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                        @if(count($paiement) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">Aucun paiement trouvé</td>
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
    </div>
</main>
<script>
    // Vérifie que le champ 'numero' n'est pas vide avant de soumettre le formulaire
    document.getElementById('numeroForm').addEventListener('submit', function(event) {
        var numero = document.getElementById('numero').value.trim();

        // Si le champ 'numero' est vide, afficher un message d'erreur et empêcher l'envoi du formulaire
        if (numero === "") {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('numero_feedback').style.display = 'block'; // Affiche le message d'erreur
            document.getElementById('numero').classList.add('is-invalid'); // Ajoute la classe pour signaler l'erreur
        }
    });

    // Cacher le message d'erreur lorsque l'utilisateur commence à taper
    document.getElementById('numero').addEventListener('input', function() {
        if (this.value.trim() !== "") {
            document.getElementById('numero_feedback').style.display = 'none'; // Masquer le message d'erreur
            this.classList.remove('is-invalid'); // Enlever la classe d'erreur
        }
    });
</script>
@endsection