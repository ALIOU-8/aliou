@extends('Admin::layout')
@section('content')
<main>
    <!-- <h1 class="title">Dashboard</h1> -->
    <ul class="breadcrumbs">
        <li><a href="">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Dashboard</a></li>
    </ul>

   <div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card border shadow">
                <div class="card-body border shadow">
                    <i class="bx bxs-user icon d-flex justify-content-center fs-2"></i><h6 class="text-center">Nombre Personnels</h6>
                    <h5 class="text-center">8</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border shadow">
                <div class="card-body border shadow">
                    <i class="bx bxs-user icon d-flex justify-content-center fs-2"></i><h6 class="text-center">Nombre Contribluables</h6>
                    <h5 class="text-center">8</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border shadow">
                <div class="card-body border shadow">
                    <i class="bx bx-building-house d-flex justify-content-center fs-2"></i><h6 class="text-center">Nombre Biens</h6>
                    <h5 class="text-center">8</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border shadow">
                <div class="card-body border shadow">
                    <i class="bx bxs-user icon d-flex justify-content-center fs-2"></i><h6 class="text-center">Nombre Utilisateur </h6>
                    <h5 class="text-center">8</h5>
                </div>
            </div>
        </div>
    </div>
   </div>
   <div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body shadow">
                    <div class="h6 text-success text-center">Choix de l'année</div>
                    <select class="form-control" name="" id="">
                        <option value="">2022</option>
                        <option value="">2023</option>
                        <option value="">2024</option>
                    </select> 
                    <hr>
                    <button class="btn btn-outline-success d-flex align-items-center gap-1">Afficher <i class="fa fa-eye"></i></button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body border shadow">
                    <div class="h6 text-danger text-center">Statistiques du recensement pour l'année 2024 </div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
   </div>
</main>
@endsection