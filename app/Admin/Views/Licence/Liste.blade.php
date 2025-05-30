@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Licence</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des Recensements licences</div>
                        <div class="row d-flex justify-content-between align-items-center me-1">
                            <div class="col-md-2">
                                <a class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1" data-bs-toggle="modal" data-bs-target="#nouveau">Nouveau<i class="bx bx-plus"></i></a>
                                <div class="modal fade" id="nouveau" tabindex="-1" aria-labelledby="nouveau" aria-hidden="true">
                                    <div class="modal-dialog center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Donnez le numéro du bien à recenser</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="recensementForm" action="{{ route('licence.recense') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="numero_bien">Numéro de Bien</label>
                                                        <input type="text" id="numero_bien" name="numero_bien" class="form-control" placeholder="Saisir le numéro">
                                                        <div id="numero_bien_feedback" class="invalid-feedback">Numéro introuvable</div>
                                                        @error('numero_bien')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>                                                        
                                                    <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Recenser<i class="bx bx-money"></i><i class="bx bx-check"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('licence.imprimer') }}" target="_blank" class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1">Imprimer <i class="bx bx-printer"></i></a>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('licence.recherche') }}">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control border border-success" placeholder="Rechercher..." value="{{ request('search') }}">
                                        <button class="btn btn-success" type="submit">Rechercher</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped " id="recensementsTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Propriétaire</th>
                                        <th>Biens</th>
                                        <th>N° bien</th>
                                        <th>Date</th>
                                        <th>Catégorie</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recencement_licence as $key=> $recencement_licences )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $recencement_licences->bien->contribuable->prenom.' '.$recencement_licences->bien->contribuable->nom }}</td>
                                        <td>{{ $recencement_licences->bien->libelle }}</td>
                                        <td>{{$recencement_licences->bien->numero_bien  }}</td>
                                        <td>{{ $recencement_licences->Date_recensement }}</td>
                                        <td>{{ $recencement_licences->categorie }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('licence.voir',$recencement_licences->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Voir<i class="bx bx-show"></i></a>
                                            <a href="{{route('impot.imposition',['type' => 'licence', 'uuid' => $recencement_licences->uuid])}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Imposer<i class="bx bx-money"></i></a>
                                            <a href="{{route('licence.modif',$recencement_licences->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if(count($recencement_licence) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun recensement trouvé</td>
                                     </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $recencement_licence->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $("#recensementForm").on("submit", function (event) {
        var numeroBien = $("#numero_bien").val();
        if (numeroBien.trim() === "") {
            event.preventDefault();
            $("#numero_bien").addClass("is-invalid");
            $("#numero_bien_feedback").text("Veuillez entrer un numéro de bien valide").show();
        }
    });

    $("#numero_bien").on("input", function () {
        var numeroBien = $(this).val();
        if (numeroBien.length > 0) {
            $.ajax({
                url: "{{ route('verifie.numero') }}",
                type: "GET",
                data: { numero_bien: numeroBien },
                success: function (response) {
                    if (response.exists) {
                        $("#numero_bien").removeClass("is-invalid").addClass("is-valid");
                        $("#numero_bien_feedback").text("Numéro valide").removeClass("invalid-feedback").addClass("valid-feedback").show();
                    } else {
                        $("#numero_bien").removeClass("is-valid").addClass("is-invalid");
                        $("#numero_bien_feedback").text("Numéro introuvable").removeClass("valid-feedback").addClass("invalid-feedback").show();
                    }
                }
            });
        } else {
            $("#numero_bien").removeClass("is-valid is-invalid");
            $("#numero_bien_feedback").text("").hide();
        }
    });
});

</script>
@endsection