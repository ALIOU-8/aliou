<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Bien extends Model
{
    use HasFactory;
    
    public function contribuable()
    {
        return $this->belongsTo(Contribuable::class);
    }

    public function typeBien()
    {
        return $this->belongsTo(TypeBien::class);
    }

    public function recensementCfu()
    {
        return $this->hasOne(Recensement_cfu::class);
    }

    public function recensementTpu()
    {
        return $this->hasOne(Recensement_tpu::class);
    }
    
    public function recensementLicence()
    {
        return $this->hasOne(Recensement_licence::class);
    }

    public function recensementPatente()
    {
        return $this->hasOne(Recensement_patente::class);
    }

    public function impots()
    {
        return $this->hasMany(Impot::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
