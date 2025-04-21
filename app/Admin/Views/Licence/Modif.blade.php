@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('licence.liste')}}">Licence</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification Licence</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement Licence </div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>                        <form action="{{route("licence.update",$recensement_licence->uuid)}}" method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="bien_id">Numero du bien<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <select class="form-control" name="bien_id" id="bien_id">
                                        <option selected value="{{$recensement_licence->bien_id}}">{{ $recensement_licence->bien->numero_bien }}</option>
                                        @foreach ($bien as $biens)
                                        @if($recensement_licence->bien_id != $biens->id)
                                        <option value="{{$biens->id}}">{{ $biens->numero_bien }}</option>
                                        @endif
                                        @endforeach
                                    </select>                
                                </div> 
                                    <div id="contribuable-info" class="col-md-6 d-block" style="display: none;">
                                        <div class="h6 mt-2">Informations du contribuable</div>
                                        <div class="h5 fw-bolder">Nom et Prénom : <span id="contribuable-name" class="fw-normal"></span></div>
                                    </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="annee_id">Année de recensement<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" class="text-success form-control" value="{{ $recensement_licence->annee->annee }}" disabled>
                                    <input type="hidden" name="annee_id" id=""  value="{{ $recensement_licence->annee_id }}"> 
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="categorie">Catégorie<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{ $recensement_licence->categorie }}" name="categorie">
                                    @error('categorie')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="Date_rdv">Date du Rendez-vous<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" value="{{ $recensement_licence->Date_rdv }}" name="Date_rdv">
                                    @error('Date_rdv')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>   
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="Date_recensement">Date de Rencensement<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" value="{{ $recensement_licence->Date_recensement }}" name="Date_recensement">
                                    @error('Date_recensement')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>         
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">Valider la modification <i class="bx bx-save"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Assure-toi que jQuery est inclus -->

<script>
    $(document).ready(function () {
        function loadContribuableData(bienId) {
            if (bienId) {
                $.ajax({
                    url: "{{ route('contribuable.details')}}",
                    type: "GET",
                    data: { id: bienId },
                    success: function (data) {
                        if (data.success) {
                            $('#contribuable-name').text(data.contribuable.nom + ' ' + data.contribuable.prenom);
                            $('#contribuable-info').show();
                        } else {
                            $('#contribuable-info').hide();
                        }
                    }
                });
            } else {
                $('#client-info').hide();
            }
        }

        // Quand on change la sélection
        $('#bien_id').on('change', function () {
            loadContribuableData($(this).val());
        });

        // Charger les données automatiquement si une valeur est déjà sélectionnée
        var selectedContribuable = $('#bien_id').val();
        loadContribuableData(selectedContribuable);
    });
</script>
@endsection