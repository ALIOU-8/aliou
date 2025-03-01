<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
{
    public function cfu()
    {
        return $this->belongsTo(Recensement_cfu::class);
    }
}
