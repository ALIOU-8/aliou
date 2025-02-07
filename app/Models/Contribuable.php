<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribuable extends Model
{
    use HasFactory;

    public function bien(){
        return $this->hasMany(Bien::class)->where('delete', 0);
    }
}
