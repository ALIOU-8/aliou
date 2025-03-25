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
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center h5 mb-3 text-success">Statistiques sur les Personnels </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Personnels</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$personnel}}                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Contribluables</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$contribuable}}                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Biens</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$bien}}                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Utilisateurs</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$user}}                                      
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
<main>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center h5 mb-3 text-success">Statistiques sur les biens de l'année {{$annee->annee}} </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Biens recenser</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$bienrecencer}}                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Biens imposer</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$bienImposer}}                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Impôts payés</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$totalImpostsPayes}}                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border shadow p-2">
                                    <div class="h5 text-center m-1 d-flex align-items-center gap-2"><i class="bx bxs-user"></i>Impôts non payés</div>
                                    <hr class="m-0">
                                    <div class="h4 text-center p-1">
                                        {{$totalImpostsNonPayes}}                                      
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
<main>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">    
                        <div class="row">
                            <div class="text-center h5 mb-3 text-success">Statistiques sur les biens de l'année {{$annee->annee}} </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border shadow">
                                        <div class="h6 text-success text-center">Statistiques du recensement pour l'année {{$annee->annee}} </div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border shadow">
                                        <div class="h6 text-success text-center">Statistiques du recensement pour l'année {{$annee->annee}} </div>
                                        <canvas id="Chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Chart en bar  --}}
    <script>
        const ctx = document.getElementById('myChart');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['CFU', 'TPU', 'PATENTE', 'LICENCE'],
                datasets: [{
                    label: '# nombre de personnes recencé',
                    data: <?php echo json_encode($data); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>  

    {{-- Chart en dognut  --}}
    <script>
        const ctx1 = document.getElementById('Chart');        
      
        new Chart(ctx1, {
          type: 'doughnut',
          data: {
            labels: ['CFU', 'TPU', 'PATENTE', 'LICENCE'],
            datasets: [{
              label: '# nombre de personnes imposé',
              data: <?php echo json_encode($dataDonught); ?>,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    </script>
</main>
@endsection

