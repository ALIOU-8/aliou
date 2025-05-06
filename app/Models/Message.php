<?php

namespace App\Models;

use App\Events\MessageSent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'content',
        'file_path', // Ajouté
        'file_name', // Ajouté
        'read_at'
    ];
    protected $dispatchesEvents = [
        'created' => MessageSent::class
    ];
    
    // Supprimez la colonne inutile (optionnel)
    protected $hidden = ['file'];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function from()
    {
       return $this->belongsTo(User::class);
    }
}
