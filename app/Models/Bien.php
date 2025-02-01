<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    public function contribuable()
    {
        return $this->belongsTo(Contribuable::class);
    }

    public function typeBien()
    {
        return $this->belongsTo(TypeBien::class);
    }
}
