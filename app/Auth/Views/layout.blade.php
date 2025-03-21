<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DGI | MAMOU</title>
    <link rel="stylesheet" href="{{asset('Admin/Css/auth.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/Css/bootstrap.min.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="image col-md-7  p-0">
                <img src="{{asset('Admin/Assets/login.jpg')}}" alt="" class="img img-fluid ">
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-center pt-5">
                    <img src="{{asset('Admin/Assets/impot.jpg')}}" alt="" class="img img-fluid ">
                </div>
                <div class="formulaire">
                    <form action="{{route('login.store')}}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="matricule">Matricule</label>
                                <input type="text" placeholder="Entrez votre matricule" class="form-control" name="matricule">
                                @error('matricule')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="password">Mot de Passe</label>
                                <input type="password" placeholder="Entrez votre mot de passe" class="form-control" name="password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <div class="text-end h6"><a href="">Mot de passe oublié ?</a></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success w-100">Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>