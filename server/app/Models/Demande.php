<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = ['parental_id', 'modalite_id', 'statut'];

    public function parent():BelongsTo
    {
        return $this->belongsTo(Parental::class);
    }

    public function enfants():BelongsToMany
    {
        return $this->belongsToMany(Enfant::class, 'demande_activite_enfants');
    }

    public function demandeActiviteEnfants():HasMany
    {
        return $this->hasMany(DemandeActiviteEnfant::class);
    }

}
