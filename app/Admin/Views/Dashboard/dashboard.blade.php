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
                            <div class="text-center h4 mb-3 text-success">Statistiques sur les Personnels </div>
                            <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-user-tie"></i> <!-- Icône personnel -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Personnels</div>
                                        <div class="user-count">{{$personnel}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('personnels.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-id-card"></i> <!-- Icône contribuable -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Contribuables</div>
                                        <div class="user-count">{{$contribuable}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('contribuable.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-building"></i> <!-- Icône biens -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Biens</div>
                                        <div class="user-count">{{$bien}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('bien.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-users-cog"></i> <!-- Icône utilisateurs -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Utilisateurs</div>
                                        <div class="user-count">{{$user}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('bien.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
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
                            <div class="text-center h4 mb-3 text-success">Statistiques sur les biens de l'année {{$annee->annee}} </div>
                            <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-folder-open"></i> <!-- Recenser -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Recensés</div>
                                        <div class="user-count">{{$bienrecencer}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('bien.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-folder"></i> <!-- Non recenser -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Non recensés</div>
                                        <div class="user-count">{{$bien - $bienrecencer}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('bien.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-file-alt"></i> <!-- Imposer -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Imposés</div>
                                        <div class="user-count">{{$bienImposer}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('bien.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3 mb-4">
                                <div class="card card-custom p-4 border shadow">
                                  <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                      <div class="icon-user">
                                        <i class="fas fa-times-circle"></i> <!-- Non imposer -->
                                      </div>
                                      <div class="pt-4">
                                        <div class="label-title">Non imposés</div>
                                        <div class="user-count">{{$bien - $bienImposer}}</div>
                                      </div>
                                    </div>
                                    <a href="{{ route('bien.imprimer') }}"><i class="fas fa-print icon-print"></i></a>
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
                            <div class="text-center h5 mb-3 text-success">Statistiques sur les recensements de l'année {{$annee->annee}} </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border shadow">
                                        <div class="h6 text-success text-center">Statistiques du recensement pour l'année {{$annee->annee}} </div>
                                        <div class="diagramme">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border shadow">
                                        <div class="h6 text-success text-center">Statistiques des impôts pour l'année {{$annee->annee}} </div>
                                        <div class="diagramme">
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
    </div>
</main>
<main>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="card border border-light">
                    <div class="card-body">    
                        <div class="row">
                            <div class="text-center h5 mb-3 text-success">Statistiques sur les biens de l'année {{$annee->annee}} </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body border shadow">
                                        <div class="h6 text-success text-center">Statistiques paiement des impôts  pour l'année {{$annee->annee}} </div>
                                        <canvas id="monChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"></div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    const ctx = document.getElementById('monChart');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['CFU', 'TPU', 'PATENTE', 'LICENCE'],
            datasets: [{
                label: 'Nombre impôts payé',
                data: <?php echo json_encode($donneePayes); ?>,
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
{{-- Chart en bar  --}}
<script>
    const ctx2 = document.getElementById('myChart');
    
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['CFU', 'TPU', 'PATENTE', 'LICENCE'],
            datasets: [{
                label: 'Nombre de  recencement',
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
          label: 'Nombre d\'imposition',
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

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale:'fr'
        });
        calendar.render();
    });

</script>

@endsection

