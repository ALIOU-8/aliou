<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impot extends Model
{
    use HasFactory;
    public function recensement_cfu()
    {
        return $this->belongsTo(Recensement_cfu::class);
    }
}
