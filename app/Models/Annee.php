<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    public function impots() {
        return $this->hasMany(Impot::class);
    }

}
