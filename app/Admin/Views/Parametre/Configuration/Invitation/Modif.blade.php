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
        <li><a href="{{route('parametre.configuration.invitation')}}">Invitation</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modification</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Modification Invitation</div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>                        <form action="{{route('parametre.configuration.invitation.update',$invitation->uuid)}}" method="post" class="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" name="nom" value="{{ $invitation->nom }}">
                                    @error('nom')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prenom<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{ $invitation->prenom }}" name="prenom">
                                    @error('prenom')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>                               
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_rdv">Date du rendez-vous<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="date" value="{{ $invitation->date_rdv }}" name="date_rdv">
                                    @error('date_rdv')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="motif">Motif<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{ $invitation->motif }}" name="motif">
                                    @error('motif')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>                          
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="se_munir">Se munir<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input class="form-control" type="text" value="{{ $invitation->se_munir }}" name="se_munir">
                                    @error('se_munir')
                                        <p class="text-danger">{{$message}}</p>
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