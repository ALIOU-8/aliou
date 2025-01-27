@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('tpu.liste')}}">TPU</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Voir TPU</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Recensement TPU </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h4>Propriétaire du bien</h4><span class="text-success h5">Bah Mamadou Saliou</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Année de recensement</h4><span class="text-success h5">2025</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Catégorie</h4><span class="text-success h5">A1</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4>Date du Rendez-vous</h4><span class="text-success h5">17/022025</span>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection