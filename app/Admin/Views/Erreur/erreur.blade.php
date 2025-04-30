<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur</title>
    <link rel="stylesheet" href="{{ asset('Admin/Css/bootstrap.min.css') }}">
</head>
<body>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block my-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-5">
                                     <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="text-center mb-4 mt-3">
                                                <div class="text-center mb-4 mt-3">
                                                    <a href=''>
                                                        <span><img src="{{ asset('Admin/Assets/Impot.jpg') }}" class="rounded-circle" alt="" height="100"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mt-4 pt-3 text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-6 my-4">
                                                        <img src="{{ asset('Admin/Assets/404-error.svg') }}" title="invite.svg">
                                                    </div>
                                                </div>
                                                <h3 class="expired-title text-danger mb-4 mt-3">Accés réfusé</h3>
                                                <p class="text-muted mt-3">Vous ne pouvez pas acceder a cette page consulter l'administrateur au <a href="tel:627486106">627486106</a> </p>
                                            </div>
            
                                            <div class="mb-3 mt-4 text-center">
                                                <a class='btn btn-primary btn-block' href='mailto:bahsaliou@gmail.com'>Consultez ici</a>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
            
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
</body>
<script src="{{ asset('Admin/JS/bootstrap.min.js') }}"></script>
</html>