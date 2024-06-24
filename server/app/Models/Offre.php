<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offre extends Model
{
    use HasFactory;
    protected $fillable = ['administrateur_id', 'titre', 'date_debut', 'date_fin', 'description', 'remise', 'photo'];

    public function activites():BelongsToMany
    {
        return $this->belongsToMany(Activite::class, 'offre_activites');
    }
}
