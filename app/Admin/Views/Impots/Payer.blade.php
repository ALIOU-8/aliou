@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('impot.liste')}}">Impôts</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Payer impôt</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Fiche de paye de Mr Sano Ismael </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <div class="">
                            <form action="" class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Montant Total</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Montant Restant</label>
                                    <input type="text" class="form-control" readonly >
                                </div>
                                <div class="col-md-6">
                                    <label for="">Montant A payer</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2">Payer <i class="bx bx-money"></i></button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="h5 mb-2 text-center text-success"> Historique de Paiement </div>
                        <div class="h6 mb-3 text-success">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab mollitia ratione quaerat natus rem iusto asperiores facilis libero est doloremque velit, suscipit repellendus cupiditate illo dolor perspiciatis labore reiciendis vitae?</div>
                        <div class="historique_de_paiement">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>Heure</th>
                                            <th>Montant Total</th>
                                            <th>Montant Payer</th>
                                            <th>Montant Restant</th>
                                            <th>Personnel</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>25/06/2025</td>
                                            <td>12h : 30min</td>
                                            <td>1.000.000 FG</td>
                                            <td>200.000 FG</td>
                                            <td>800.000 FG</td>
                                            <td>Sano Ismael</td>
                                            <td class="d-flex justify-content-center gap-2">
                                                <a href="{{route('impot.payer',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Réçu<i class="bx bx-money"></i></a>
                                                <a href="{{route('impot.modif',1)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection