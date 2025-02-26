<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recensement_patente extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }
}
