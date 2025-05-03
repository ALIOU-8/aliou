<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DGI | MAMOU</title>
    <link rel="shortcut icon" href="{{asset('Admin/Assets/Impot.jpg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('Admin/Css/main.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/Css/bootstrap.min.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link rel="manifest" href="/manifest.webmanifest">
    <meta name="theme-color" content="#0d6efd">
    <link rel="icon" type="image/png" href="{{ asset('Admin/Assets/Impot.png') }}">
    <link rel="manifest" href="/manifest.webmanifest?v=3">
</head>
<body>
    <!-- sidebar -->
    <section id="sidebar">
        <a href="" class="brand"><img src="{{asset('Admin/Assets/impot.jpg')}}" class="rounded-circle" alt="">DGI MAMOU</a>
        <ul class="side-menu">
            @if (Auth::user()->droit != 'admin' )
                <li>
                    <a href="{{ route('dashboard.'.Auth::user()->droit) }}" class="{{ Route::is('dashboard.*') ? 'active' : '' }}">
                        <i class="bx bxs-dashboard icon"></i>Dashboard
                    </a>
                </li>
            @endif
            @if (Auth::user()->droit === "admin")
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="bx bxs-dashboard icon"></i>Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{route('personnels.liste')}}" class="{{ Route::is('personnels.*') ? 'active' : '' }}">
                        <i class="bx bxs-user icon"></i>Gestion Personnel
                    </a>
                </li>
            @endif
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
            @if (Auth::user()->droit === "cfu" || Auth::user()->droit === "admin")    
                <li>
                    <a href="{{route('cfu.liste')}}" class="{{ Route::is('cfu.*') ? 'active' : '' }}">
                        <i class="bx bx-building-house icon"></i>Gestion CFU
                    </a>
                </li>
            @endif
            @if (Auth::user()->droit === "tpu" || Auth::user()->droit === "admin")
                <li>
                    <a href="{{route('tpu.liste')}}" class="{{ Route::is('tpu.*') ? 'active' : '' }}">
                        <i class="bx bxs-business icon"></i>Gestion TPU
                    </a>
                </li>
            @endif
            @if (Auth::user()->droit === "patente" || Auth::user()->droit === "admin")
                
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
            @endif
            <li>
                <a href="{{route('impot.liste')}}" class="{{ Route::is('impot.*') ? 'active' : '' }}">
                    <i class="bx bxs-wallet icon"></i>Gestion Impôts
                </a>
            </li>
            @if (Auth::user()->droit === "admin")     
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
            @endif
        </ul>        
    
        {{-- <div class="wrapper">
            <a href="{{route('logout')}}" class="btn-upgrade"><i class='bx bx-log-out icon'></i>Déconnexion</a>                
        </div> --}}
       
    </section>
    <!-- sidebar -->

    <!-- navbar  -->
    <section id="content">
        <!-- navbar  -->
        <nav>
            <i class="bx bx-menu toogle-sidebar"></i>
            <form action="">
                <div class="form-group">
                    <input type="hidden" placeholder="Search..." >
                    {{-- <i class="bx bx-search icon"></i> --}}
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
                <img  src="{{asset('/storage/profil/'.Auth()->user()->image)}}" alt="">
                <ul class="profile-link">
                    <li><a href="{{route('profil')}}"><i class="bx bxs-user-circle icon"></i>Profil</a></li>
                    {{-- <li><a href=""><i class="bx bxs-cog icon"></i>Setting</a></li> --}}
                    <li><a href="{{route('logout')}}"><i class="bx bxs-log-out-circle icon"></i>Logout</a></li>
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
    <script src="{{asset('Admin/JS/main.js')}}"></script>
    <script src="{{asset('Admin/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('Admin/JS/bootstrap.bundle.js')}}"></script>
    <script>
        if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
            .then(function(registration) {
                console.log('Service Worker enregistré avec succès:', registration);
            })
            .catch(function(error) {
                console.log('Erreur lors de l’enregistrement du Service Worker:', error);
            });
    }
    </script>
</body>
</html>