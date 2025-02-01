<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }
}
