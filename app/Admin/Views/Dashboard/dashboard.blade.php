@extends('Admin::layout')
@section('content')
<main>
    <!-- <h1 class="title">Dashboard</h1> -->
    <ul class="breadcrumbs">
        <li><a href="">Home</a></li>
        {{-- <li class="divider">/</li>
        <li><a href="" class="active">Dashboard</a></li> --}}
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Nombre de Personnels</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center mt-1 mb-1 p-1">
                                        10                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Nombre de Contribluables</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center mt-1 mb-1 p-1">
                                        10                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Nombre de Biens</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center mt-1 mb-1 p-1">
                                        10                                      
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border shadow">
                                        <div class="h6 text-danger text-center">Statistiques du recensement pour l'année 2024 </div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection