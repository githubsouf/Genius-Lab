<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Enfant extends Model
{
    use HasFactory;

    protected $fillable = ['parental_id', 'nom', 'prenom', 'photo', 'date_naissance', 'genre'];

    public function horairesdispo():BelongsToMany
    {
        return $this->belongsToMany(Horaire::class, 'dispo_enfants');
    }

    //les horaires ou l'enfant a des activites
    public function horaires():BelongsToMany
    {
        return $this->belongsToMany(Horaire::class, 'participers', 'enfant_id', 'horaire_id')->withPivot('activite_id');
    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(Parental::class);
    }

    public function interets():BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'enfant_interets');
    }

    public function activites():BelongsToMany
    {
        return $this->belongsToMany(Activite::class, 'demande_activite_enfants');
    }

    public function demandes():BelongsToMany
    {
        return $this->belongsToMany(Demande::class, 'demande_activite_enfants');
    }

}

