@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('cfu.liste')}}">CFU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Voir CFU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement CFU </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h4>Propriétaire du bien</h4><span class="text-success h5">Bah Mamadou Saliou</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Année de recensement</h4><span class="text-success h5">2025</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Catégorie</h4><span class="text-success h5">A</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Date de recensement</h4><span class="text-success h5">12-12-2025</span>
                                </div>
                                <hr>      
                                <div class="text-center h4 text-success">Caractéristiques du batiment</div>         
                                <div class="col-md-6 mb-3">
                                    <h4>Nombre d'etage</h4><span class="text-success h5">3</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Surface</h4><span class="text-success h5">3 m</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Nature Fondation</h4><span class="text-success h5">beton</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Nature mur</h4><span class="text-success h5">Brique</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Nature toi</h4><span class="text-success h5">Tôle</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Nombre d'unité</h4><span class="text-success h5">12</span>
                                </div>             
                                <div class="col-md-6 mb-3">
                                    <h4>Nombre d'unité occupée</h4><span class="text-success h5">3</span>
                                </div>
                                <hr>      
                                <div class="text-center h4 text-success">Les Occupants du batiment</div>         
                                <div class="col-md-6 mb-3">
                                    <h4>Nom</h4><span class="text-success h5">Sano</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Prénom</h4><span class="text-success h5">Ismael</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Niveau</h4><span class="text-success h5">1</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Unité</h4><span class="text-success h5">1</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Activité</h4><span class="text-success h5">Marchand</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Valeur locative</h4><span class="text-success h5">12</span>
                                </div>             
                                <div class="col-md-6 mb-3">
                                    <h4>Observation</h4><span class="text-success h5">Cool</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Type d'occupant</h4><span class="text-success h5">Inconu</span>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection