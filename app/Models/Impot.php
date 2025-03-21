<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Impot extends Model
{
    use HasFactory;
    public function recensement_cfu()
    {
        return $this->belongsTo(Recensement_cfu::class);
    }
    public function recensement_tpu()
    {
        return $this->belongsTo(Recensement_tpu::class);
    }
    public function recensement_licence()
    {
        return $this->belongsTo(Recensement_licence::class);
    }
    public function recensement_patente()
    {
        return $this->belongsTo(Recensement_patente::class);
    }
    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function registre()
    {
        return $this->belongsTo(Registre::class);
    }

    public function paiement()
    {
        return $this->hasMany(Paiement::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
