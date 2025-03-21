@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('biens.liste')}}">Biens</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification Bien</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Modificatioin d'un bien</div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{route('biens.update',$bien->uuid)}}" method="post" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="contribuable_id">Propriétaire du bien</label>
                                    <select name="contribuable_id" id="contribuable_id" class="form-control">
                                        @foreach ($contribuable as $contribuables)
                                            <option value="{{ $contribuables->id }}" 
                                                {{ old('contribuable_id', $bien->contribuable_id) == $contribuables->id ? 'selected' : '' }}>
                                                {{ $contribuables->telephone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('contribuable_id')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 d-block">
                                    <div id="client-info" class="col-md-6 d-block" style="display: none;">
                                        <div class="h6 mt-2">Informations du client</div>
                                        <div class="h5 fw-bolder">Nom et Prénom : <span id="client-name" class="fw-normal"></span></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type_bien_id">Type de bien</label>
                                    <select name="type_bien_id" id="type_bien_id" class="form-control">
                                        <option selected value="{{ $bien->type_bien_id }}">{{ $bien->typeBien->libelle }}</option>
                                        @foreach ($typeBien as $typeBiens )
                                        @if($bien->type_bien_id != $typeBiens->id)
                                            <option value="{{ $typeBiens->id }}">{{ $typeBiens->libelle }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('type_bien_id')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libelle">Libéllé</label>
                                    <input class="form-control" type="text" name="libelle" value="{{ $bien->libelle}}">
                                    @error('libelle')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="adresse">Adresse</label>
                                    <input class="form-control" type="text" value="{{ $bien->adresse }}" name="adresse">
                                    @error('adresse')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>                               
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-outline-success col-6 col-md-3">Valider la modification</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function loadContribuableData(contribuableId) {
            if (contribuableId) {
                $.ajax({
                    url: "{{ route('get.contribuable') }}",
                    type: "GET",
                    data: { id: contribuableId },
                    success: function (data) {
                        if (data.success) {
                            $('#client-name').text(data.contribuable.nom + ' ' + data.contribuable.prenom);
                            $('#client-info').show();
                        } else {
                            $('#client-info').hide();
                        }
                    }
                });
            } else {
                $('#client-info').hide();
            }
        }

        // Quand on change la sélection
        $('#contribuable_id').on('change', function () {
            loadContribuableData($(this).val());
        });

        // Charger les données automatiquement si une valeur est déjà sélectionnée
        var selectedContribuable = $('#contribuable_id').val();
        loadContribuableData(selectedContribuable);
    });
</script>

@endsection