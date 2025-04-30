@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Home</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('impot.liste')}}">Impôts</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Modifier paiement</a></li>
    </ul>
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12 ">
                <div class="card border border-light">
                    <div class="card-body">
                        <div class="h5 mb-2 text-center text-success"> Fiche de paye de Mr/Mme {{$paiement->impot->bien->contribuable->nom . ' ' . $paiement->impot->bien->contribuable->prenom }}  </div>
                        <div class="h6 mb-3 text-danger"><span>NB:<span class="required-start text-danger text-bolder p-2">*</span>Tous les champs marqués d'une étoile sont obigatoires</span></div>
                        <div class="">
                            <form action="{{ route('impot.payement.update',$paiement->uuid) }}" method="POST" class="row">
                                @csrf
                                @method('put')
                                <div class="col-md-6 mb-3">
                                    <label for="">Montant A payer</label>
                                    <input type="text" class="form-control" value="{{ number_format($paiement->impot->montant_a_payer, 0, ',', ' ') }} GNF" name="montant_total" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="montant">Montant<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" name="montant"  class="form-control" value="{{$paiement->montant_payer  }}">
                                    @error('montant')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="num_quitance">Numéro de quitance<span class="required-start text-danger text-bolder p-2">*</span></label>
                                    <input type="text" name="num_quitance"  class="form-control" value="{{ $paiement->num_quitance}}">
                                    @error('num_quitance')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2">Modifier <i class="bx bx-money"></i></button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        {{-- <div class="h5 mb-2 text-center text-success"> Historique de Paiement </div>
                        <div class="historique_de_paiement">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>Montant Total</th>
                                            <th>Montant Payer</th>
                                            <th>Montant Restant</th>
                                            <th>N° de quitance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paiement as $key=> $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td> {{$item->created_at}} </td>
                                            <td>{{$impot->montant_a_payer}}</td>
                                            <td>{{$item->montant_payer}}</td>
                                            <td>{{$item->montant_restant}}</td>
                                            <td>{{$item->num_quitance}}</td>
                                            <td class="d-flex justify-content-center gap-2">
                                                <a href="{{route('impot.modif.payement',$item->uuid)}}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">Modifier<i class="bx bx-edit"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if(count($paiement) == 0)
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun paiement trouvé</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection