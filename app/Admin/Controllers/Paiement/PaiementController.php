<?php

namespace App\Admin\Controllers\Paiement;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Impot;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index () {
        $anneeActive = Annee::where('active', 1)->firstOrFail();
        // Récupérer les IDs des impôts liés à l'année active
        $impotsIds = Impot::where('annee_id', $anneeActive->id)->pluck('id');
        // Filtrer les paiements en fonction des impôts récupérés
        $paiement = Paiement::whereIn('impot_id', $impotsIds)->with('impot')->get();
        

        return view('Admin::Paiement.Liste',compact('paiement','anneeActive'));
    }

    public function chercheNumero(Request $request)
    {
        $request->validate([
            'numero'=>'required',
        ]);
        $impot=Impot::where('numero',$request->numero)->first();
        if(!$impot)
        {
            toastr()->error("numero de l'avis introuvable");
            return back();
        }else{
            return to_route('impot.payer',$impot->id);
        }
    }

    public function recherche(Request $request)
{
    $query = Paiement::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('montant_payer', 'LIKE', "%{$search}%")
              ->orWhere('montant_restant', 'LIKE', "%{$search}%")
              ->orWhere('num_quitance', 'LIKE', "%{$search}%")
              ->orWhereHas('impot', function ($impotQuery) use ($search) {
                  $impotQuery->whereHas('recensement_cfu', function ($recensementQuery) use ($search) {
                      $recensementQuery->whereHas('bien.contribuable', function ($contribuableQuery) use ($search) {
                          $contribuableQuery->where('nom', 'LIKE', "%{$search}%")
                                             ->orWhere('prenom', 'LIKE', "%{$search}%")
                                             ->orWhere('telephone', 'LIKE', "%{$search}%");
                      });
                  });
              })
              ->orWhereHas('impot', function ($impotQuery) use ($search) {
                $impotQuery->whereHas('recensement_tpu', function ($recensementQuery) use ($search) {
                    $recensementQuery->whereHas('bien.contribuable', function ($contribuableQuery) use ($search) {
                        $contribuableQuery->where('nom', 'LIKE', "%{$search}%")
                                           ->orWhere('prenom', 'LIKE', "%{$search}%")
                                           ->orWhere('telephone', 'LIKE', "%{$search}%");
                                           
                    });
                });
            })
            ->orWhereHas('impot', function ($impotQuery) use ($search) {
                $impotQuery->whereHas('recensement_patente', function ($recensementQuery) use ($search) {
                    $recensementQuery->whereHas('bien.contribuable', function ($contribuableQuery) use ($search) {
                        $contribuableQuery->where('nom', 'LIKE', "%{$search}%")
                                           ->orWhere('prenom', 'LIKE', "%{$search}%")
                                           ->orWhere('telephone', 'LIKE', "%{$search}%");
                    });
                });
            })
            ->orWhereHas('impot', function ($impotQuery) use ($search) {
                $impotQuery->whereHas('recensement_licence', function ($recensementQuery) use ($search) {
                    $recensementQuery->whereHas('bien.contribuable', function ($contribuableQuery) use ($search) {
                        $contribuableQuery->where('nom', 'LIKE', "%{$search}%")
                                           ->orWhere('prenom', 'LIKE', "%{$search}%")
                                           ->orWhere('telephone', 'LIKE', "%{$search}%");
                    });
                });
            });
        });
    }

    $paiement = $query->paginate(10);
    return view('Admin::Paiement.Liste', compact('paiement'));
}

}
