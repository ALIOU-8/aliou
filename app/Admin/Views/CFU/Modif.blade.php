@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification CFU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement CFU </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{ route('cfu.update',$recencement_cfu->id) }}" method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="bien_id">Numero du bien</label>
                                    <select class="form-control" name="bien_id" id="bien_id">
                                        <option selected value="{{$recencement_cfu->bien_id}}">{{ $recencement_cfu->bien->numero_bien }}</option>
                                        @foreach ($bien as $biens)
                                        @if($recencement_cfu->bien_id != $biens->id)
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
                                    <input type="text" class="text-success form-control" value="{{ $recencement_cfu->annee->annee }}" disabled>
                                    <input type="hidden" name="annee_id" id=""  value="{{ $recencement_cfu->annee_id }}"> 
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="statut">Statut</label>
                                    <select name="statut" class="form-control" id="">
                                        <option selected  value="{{ $recencement_cfu->statut }}">{{ $recencement_cfu->statut }}</option>
                                        @foreach ($statut as $statuts )
                                            @if ($statuts!= $recencement_cfu->statut)
                                                 <option   value="{{ $statuts }}">{{ $statuts }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('statut')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type">Type</label>
                                    <select name="type" class="form-control" id="">
                                        <option selected value="{{ $recencement_cfu->type }}">{{ $recencement_cfu->type }}</option>
                                        @foreach ($type as $types )
                                        @if ($types!= $recencement_cfu->type)
                                             <option   value="{{ $types }}">{{ $types }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                    @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_rdv">Date du Rendez-vous</label>
                                    <input class="form-control" type="date" value="{{ $recencement_cfu->date_rdv }}" name="date_rdv">
                                    @error('date_rdv')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_recensement">Date Recensement</label>
                                    <input class="form-control" type="date"  value="{{ $recencement_cfu->date_recensement }}" name="date_recensement">
                                    @error('date_recensement')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <hr>      
                                <div class="text-center h5 text-success">Caractéristiques du batiment</div>         
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nbre_etage">Nombre d'étage</label>
                                    <input class="form-control" type="number" value="{{ $recencement_cfu->nbre_etage }}" name="nbre_etage">
                                    @error('nbre_etage')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="surface">Surface</label>
                                    <input class="form-control" type="text" value="{{ $recencement_cfu->surface }}" name="surface">
                                    @error('surface')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nature_fondation">Nature fondation</label>
                                    <select name="nature_fondation" class="form-control" id="">
                                        <option selected value="{{ $recencement_cfu->nature_fondation }}">{{ $recencement_cfu->nature_fondation }}</option>
                                     @foreach ($n_fondation as $n_fondations )
                                        @if ($n_fondations!= $recencement_cfu->nature_fondation)
                                             <option   value="{{ $n_fondations }}">{{ $n_fondations }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                    @error('nature_fondation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nature_mur">Nature mur</label>
                                    <select name="nature_mur" class="form-control" id="">
                                        <option selected value="{{ $recencement_cfu->nature_mur }}">{{ $recencement_cfu->nature_mur }}</option>
                                        @foreach ($n_mur as $n_murs )
                                        @if ($n_murs!= $recencement_cfu->nature_mur)
                                             <option   value="{{ $n_murs }}">{{ $n_murs }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                    @error('nature_mur')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nature_toit">Nature toit</label>
                                    <select name="nature_toit"  class="form-control" id="">
                                        <option  selected value="{{ $recencement_cfu->nature_toit }}">{{ $recencement_cfu->nature_toit }}</option>
                                        @foreach ($n_toit as $n_toits )
                                        @if ($n_toits!= $recencement_cfu->nature_toit)
                                             <option   value="{{ $n_toits }}">{{ $n_toits }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                    @error('nature_toit')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"  for="nombre_unite">Nombre unité</label>
                                    <input class="form-control" value="{{ $recencement_cfu->nombre_unite }}" type="number" name="nombre_unite">
                                    @error('nombre_unite')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nombre_unite_occuper">Nombre unité Occupée</label>
                                    <input class="form-control" type="number" value="{{ $recencement_cfu->nombre_unite_occuper }}" name="nombre_unite_occuper">
                                    @error('nombre_unite_occuper')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>                
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3 d-flex justify-content-center align-items-center gap-1">Enregistrer <i class="bx bx-save"></i></button>
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
                    url: "{{ route('cfu.contribuable.details')}}",
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