<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Horaire extends Model
{
    use HasFactory;
    protected $fillable = ['jour', 'heure_debut', 'heure_fin'];

    public function animateursdispo():BelongsToMany
    {
        return $this->belongsToMany(Animateur::class,'dispo_animateurs');
    }

    public function enfantsdispo():BelongsToMany
    {
        return $this->belongsToMany(Enfant::class,'dispo_enfants');
    }

    public function activites():BelongsToMany
    {
        return $this->belongsToMany(Activite::class,'activite_horaires')->withPivot('num_seance');;
    }

    //les animateures qui ont des activite dans une horaire donne
    public function animateurs():BelongsToMany
    {
        return $this->belongsToMany(Animateur::class, 'animers', 'horaire_id', 'animateur_id')->withPivot('activite_id');
    }

    //les enfants qui ont des activites dans l'horaire donne
    public function enfants()
    {
        return $this->belongsToMany(Enfant::class, 'participers', 'horaire_id', 'enfant_id')->withPivot('activite_id');
    }

}
