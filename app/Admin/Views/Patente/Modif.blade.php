@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('patente.liste')}}">Patente</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification Patente</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement Patente </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{route("patente.update",$recensement_patente->id)}}" method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="bien_id">Numero du bien</label>
                                    <select class="form-control" name="bien_id" id="bien_id">
                                        <option selected value="{{$recensement_patente->bien_id}}">{{ $recensement_patente->bien->numero_bien }}</option>
                                        @foreach ($bien as $biens)
                                        @if($recensement_patente->bien_id != $biens->id)
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
                                    <label class="form-label" for="annee_id">Année de recensement</label>
                                    <input type="text" class="text-success form-control" value="{{ $recensement_patente->annee->annee }}" disabled>
                                    <input type="hidden" name="annee_id" id=""  value="{{ $recensement_patente->annee_id }}"> 
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="categorie">Catégorie</label>
                                    <input class="form-control" type="text" value="{{ $recensement_patente->categorie }}" name="categorie">
                                    @error('categorie')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="Date_rdv">Date du Rendez-vous</label>
                                    <input class="form-control" type="date" value="{{ $recensement_patente->Date_rdv }}" name="Date_rdv">
                                    @error('Date_rdv')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>   
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="Date_recensement">Date de Rencensement</label>
                                    <input class="form-control" type="date" value="{{ $recensement_patente->Date_recensement }}" name="Date_recensement">
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
                    url: "{{ route('patente.contribuable.details')}}",
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