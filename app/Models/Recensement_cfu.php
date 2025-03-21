<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Recensement_cfu extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id')->where('delete', 0);
    }
    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function occupant()
    {
        return $this->hasMany(Occupant::class)->where('delete', 0);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
