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
        <li><a href="" class="active">Ajout</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success">Nouvelle Invitation</div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <form action="{{route('parametre.configuration.invitation.store')}}" method="post" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input class="form-control" type="text" name="nom" value="{{ old('nom') }}">
                                    @error('nom')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="prenom">Prenom</label>
                                    <input class="form-control" type="text" value="{{ old('prenom') }}" name="prenom">
                                    @error('prenom')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>                               
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="date_rdv">Date du rendez-vous</label>
                                    <input class="form-control" type="date" value="{{ old('date_rdv') }}" name="date_rdv">
                                    @error('date_rdv')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="motif">Motif</label>
                                    <input class="form-control" type="text" value="{{ old('motif') }}" name="motif">
                                    @error('motif')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>                          
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="se_munir">Se munir</label>
                                    <input class="form-control" type="text" value="{{ old('se_munir') }}" name="se_munir">
                                    @error('se_munir')
                                        <p class="text-danger">{{$message}}</p>
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