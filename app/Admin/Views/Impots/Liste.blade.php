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
            <div class="col-md-12 mb-5 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 text-center text-success">La liste des Impôts</div>
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
                                                <form id="recensementForm" action="{{ route('rechercher_bien') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <label for="numero_bien">Numéro de Bien</label>
                                                            <input type="text" id="numero_bien" name="numero_bien" class="form-control" placeholder="Saisir le numéro">
                                                            <div id="numero_bien_feedback" class="invalid-feedback">Numéro introuvable</div>
                                                            @error('numero_bien')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Choisir le recensement</label>
                                                                <select name="type" id="type"  class="form-control">
                                                                    <option value=""></option>
                                                                    <option value="cfu">CFU</option>
                                                                    <option value="tpu">TPU</option>
                                                                    <option value="patente">PATENTE</option>
                                                                    <option value="licence">LICENCE</option>
                                                                </select>
                                                                <div id="type_feedback" class="invalid-feedback">Numéro introuvable</div>
                                                                    @error('type')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                    </div>                                                        
                                                    <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">Imposer<i class="bx bx-money"></i><i class="bx bx-check"></i></button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                {{-- <a href="{{route('impot.imposition',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Imposer<i class="bx bx-money"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-outline-success btn-sm-lg d-flex align-items-center justify-content-center gap-1"data-bs-toggle="modal" data-bs-target="#imprimer">Imprimer <i class="bx bx-printer"></i></a>
                                <div class="modal fade" id="imprimer" tabindex="-1" aria-labelledby="imprimer" aria-hidden="true">
                                    <div class="modal-dialog center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Que voulez-vous imprimer ?</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex gap-3">
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">CFU<i class="bx bxs-printer"></i></button>
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">TPU<i class="bx bxs-printer"></i></button>
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">PATENTE<i class="bx bxs-printer"></i></button>
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">LICENCE<i class="bx bxs-printer"></i></button>
                                                <button type="submit" class="btn btn-outline-success btn-sm mt-2 d-flex align-items-center gap-1">TOUT<i class="bx bxs-printer"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <form method="GET" action="{{ route('impots.recherche') }}">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control border border-success" placeholder="Rechercher..." value="{{ request('search') }}">
                                        <button class="btn btn-success" type="submit">Rechercher</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="impotTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Impôt</th>
                                        <th>Nom et prenom</th>
                                        <th>Montant à payer</th>
                                        <th>Date limite</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($impot as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="text-uppercase"> {{$item->type_impot}} </td>
                                        @if($item->type_impot=='patente')
                                        <td>{{$item->recensement_patente->bien->contribuable->nom.' '.$item->recensement_patente->bien->contribuable->prenom}}</td>
                                        @endif
                                        @if($item->type_impot=='licence')
                                        <td>{{$item->recensement_licence->bien->contribuable->nom.' '.$item->recensement_licence->bien->contribuable->prenom}}</td>
                                        @endif
                                        @if($item->type_impot=='cfu')
                                        <td>{{$item->recensement_cfu->bien->contribuable->nom.' '.$item->recensement_cfu->bien->contribuable->prenom}}</td>
                                        @endif
                                        @if($item->type_impot=='tpu')
                                        <td>{{$item->recensement_tpu->bien->contribuable->nom.' '.$item->recensement_tpu->bien->contribuable->prenom}}</td>
                                        @endif
                                        <td> {{ number_format($item->montant_a_payer, 0, ',', ' ') }} FG </td>
                                        <td> {{$item->date_limite}} </td>
                                        <td class="@if($item->statut == "nonPayé") text-danger @endif @if($item->statut == "Payé") text-success @endif @if($item->statut == "Encours") text-warning @endif"> {{$item->statut}} </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a href="{{route('impot.voir',['type' => $item->type_impot, 'uuid' => $item->uuid])}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Avis<i class="bx bx-show"></i></a>
                                            <a href="{{route('impot.payer',$item->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Payer<i class="bx bx-money"></i></a>
                                            <a href="{{route('impot.modif',$item->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if(count($impot) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun Impôt trouvé</td>
                                     </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $impot->links('pagination::bootstrap-4') }}
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
        var type=$('#type').val();
        if (numeroBien.trim() === "") {
            event.preventDefault();
            $("#numero_bien").addClass("is-invalid");
            $("#numero_bien_feedback").text("Veuillez entrer un numéro de bien valide").show();
        }
        if (type.trim() === "") {
            event.preventDefault();
            $("#type").addClass("is-invalid");
            $("#type_feedback").text("Veuillez entrer un numéro de bien valide").show();
        }
    });

    $("#type").on("input", function () {
        var type = $(this).val();
        if (type.length > 0) {
            $("#type").removeClass("is-invalid").addClass("is-valid");
            $("#type_feedback").text("type valide").removeClass("invalid-feedback").addClass("valid-feedback").show();
        } else {
            $("#type").removeClass("is-valid is-invalid");
            $("#type_feedback").text("").hide();
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