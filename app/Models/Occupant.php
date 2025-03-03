<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
{
    public function  recensementCfu()
    {
        return $this->belongsTo(Recensement_cfu::class,'cfu_id');
    }

}
