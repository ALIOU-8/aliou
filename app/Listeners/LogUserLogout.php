<?php

namespace App\Listeners;

use App\Models\Annee;
use App\Models\Historique;
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
                'action'=>'Déconnecter',
                'activite'=>'utilisateur',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
    }
}
