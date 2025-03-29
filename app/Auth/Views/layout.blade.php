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
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
</body>
</html>