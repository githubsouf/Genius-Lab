<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Objectif extends Model
{
    use HasFactory;
 
    protected $fillable = ['activite_id', 'objectifs_detailles'];
    public function activite():BelongsTo
    {
        return $this->belongsTo(Activite::class);
    }
}
