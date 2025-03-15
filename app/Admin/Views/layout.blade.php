<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DGI | MAMOU</title>
    <link rel="stylesheet" href="{{asset('Admin/Css/main.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/Css/bootstrap.min.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <!-- sidebar -->
    <section id="sidebar">
        <a href="" class="brand"><img src="{{asset('Admin/Assets/impot.jpg')}}" class="rounded-circle" alt="">DGI MAMOU</a>
        <ul class="side-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <i class="bx bxs-dashboard icon"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="{{route('personnels.liste')}}" class="{{ Route::is('personnels.*') ? 'active' : '' }}">
                    <i class="bx bxs-user icon"></i>Gestion Personnel
                </a>
            </li>
            <li>
                <a href="{{route('contribuables.liste')}}" class="{{ Route::is('contribuables.*') ? 'active' : '' }}">
                    <i class="bx bxs-user icon"></i>Gestion Contribuables
                </a>
            </li>
            <li>
                <a href="{{route('biens.liste')}}" class="{{ Route::is('biens.*') ? 'active' : '' }}">
                    <i class="bx bx-building-house icon"></i>Gestion Biens
                </a>
            </li>
            <li>
                <a href="{{route('cfu.liste')}}" class="{{ Route::is('cfu.*') ? 'active' : '' }}">
                    <i class="bx bx-building-house icon"></i>Gestion CFU
                </a>
            </li>
            <li>
                <a href="{{route('tpu.liste')}}" class="{{ Route::is('tpu.*') ? 'active' : '' }}">
                    <i class="bx bxs-business icon"></i>Gestion TPU
                </a>
            </li>
            <li>
                <a href="{{route('patente.liste')}}" class="{{ Route::is('patente.*') ? 'active' : '' }}">
                    <i class="bx bxs-inbox icon"></i>Gestion Patente
                </a>
            </li>
            <li>
                <a href="{{route('licence.liste')}}" class="{{ Route::is('licence.*') ? 'active' : '' }}">
                    <i class="bx bxs-inbox icon"></i>Gestion Licence
                </a>
            </li>
            <li>
                <a href="{{route('impot.liste')}}" class="{{ Route::is('impot.*') ? 'active' : '' }}">
                    <i class="bx bxs-wallet icon"></i>Gestion Impôts
                </a>
            </li>
            <li>
                <a href="{{route('paiement.liste')}}" class="{{ Route::is('paiement.*') ? 'active' : '' }}">
                    <i class="bx bxs-wallet icon"></i>Gestion Paiements
                </a>
            </li>
            <li>
                <a href="{{route('parametre.index')}}" class="{{ Route::is('parametre.*') ? 'active' : '' }}">
                    <i class="bx bxs-cog icon"></i>Paramètre
                </a>
            </li>
        </ul>        
    
        <div class="wrapper">
            <a href="" class="btn-upgrade"><i class='bx bx-log-out icon'></i>Déconnexion</a>                
        </div>
       
    </section>
    <!-- sidebar -->

    <!-- navbar  -->
    <section id="content">
        <!-- navbar  -->
        <nav>
            <i class="bx bx-menu toogle-sidebar"></i>
            <form action="">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class="bx bx-search icon"></i>
                </div>
            </form>
            <div class="nav-link">
                <i id="notifbtn" class="bx bxs-bell icon"></i>
                <span class="badge">5</span>
                <div class="notif">
                    <div class="header">
                        <span>Notification</span>
                        <a href=""><button type="button" class="btn-view">Voir tout</button></a>
                    </div>
                    <div class="body">
                        <a href="" class="ligne">
                            <span>Nouveau recensement</span>
                            <p> 3 mins</p>
                        </a>
                        <a href="" class="ligne">
                            <span>Nouveau recensement</span>
                            <p> 3 mins</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="nav-link">
                <i id="messagebtn" class="bx bxs-message-square-dots icon"></i>
                <span class="badge">9</span>
                <div class="messageriemin">
                    <a href="">
                        <img src="{{asset('Admin/Assets/image1.jpg')}}" alt="">
                        <p class="username">Username</p>
                        <p class="contenu">Contenu</p>
                        <p class="temps">Il y'a 4h</p>
                    </a>
                    <hr>
                    <a href="">
                        <img src="{{asset('Admin/Assets/image1.jpg')}}" alt="">
                        <p class="username">Username</p>
                        <p class="contenu">Contenu</p>
                        <p class="temps">Il y'a 4h</p>
                    </a>
                </div>
            </div>
            <div class="nav-link">
                <a href="">
                    <i id="notifbtn" class="bx bx-help-circle fs-4 icon"></i>
                </a>
            </div>
            <span class="divider"></span>
            <div class="profile">
                <img src="{{asset('Admin/Assets/image1.jpg')}}" alt="">
                <ul class="profile-link">
                    <li><a href="{{route('profil')}}"><i class="bx bxs-user-circle icon"></i>Profil</a></li>
                    {{-- <li><a href=""><i class="bx bxs-cog icon"></i>Setting</a></li> --}}
                    <li><a href=""><i class="bx bxs-log-out-circle icon"></i>Logout</a></li>
                </ul>
            </div>
        </nav> 
        <!-- navbar  -->

        <!-- main  -->
        
        @yield('content')
        
        <!-- main  -->
    </section> 
    <!-- navbar  -->
    <!-- footer  -->
    <section id="footer">
        <div class="d-flex justify-content-between align-items-center">
            <div class="h6">copyright 2024 © tous droit reservé</div>
            <div class="h6">DGI de Mamou </div>
        </div>
    </section>

     <!-- end footer  -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('Admin/JS/main.js')}}"></script>
    <script src="{{asset('Admin/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('Admin/JS/bootstrap.bundle.js')}}"></script>
    <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 5, 2, 3],
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
    
</body>
</html>