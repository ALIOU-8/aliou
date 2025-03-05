@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('licence.liste')}}">Licence</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Voir Licence</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement Licence </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h4>Propriétaire du bien</h4><span class="text-success h5">{{ $recencement_licence->bien->contribuable->nom.' '.$recencement_licence->bien->contribuable->prenom  }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Année de recensement</h4><span class="text-success h5">{{ $recencement_licence->annee->annee }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Catégorie</h4><span class="text-success h5">{{ $recencement_licence->categorie }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Date du Rendez-vous</h4><span class="text-success h5">{{ $recencement_licence->Date_rdv }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Date de Recensement</h4><span class="text-success h5">{{ $recencement_licence->Date_recensement }}</span>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection