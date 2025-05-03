<?php

namespace App\Listeners;

use App\Models\Annee;
use App\Models\Historique;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Bien',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
    }
}
