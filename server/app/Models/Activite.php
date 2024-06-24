<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = ['administrateur_id', 'titre', 'description', 'age_min', 'age_max', 'type_activite', 'eff_min', 'eff_max', 'nom', 'categorie', 'service', 'photo', 'mode_de_realisation', 'nbre_seance','prix'];

    //les horaires liees a l'activite
    public function horairesactivite(): BelongsToMany
    {
        return $this->belongsToMany(Horaire::class, 'activite_horaires')->withPivot('num_seance');;
    }

    //l'animateur de l'activite et ces horaires
    public function animateurs(): BelongsToMany
    {
        return $this->belongsToMany(Animateur::class, 'animers', 'activite_id', 'animateur_id')->withPivot('horaire_id');
    }

    public function enfants(): BelongsToMany
    {
        return $this->belongsToMany(Enfant::class, 'participers', 'activite_id', 'enfant_id')->withPivot('horaire_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function objectifs(): HasMany
    {
        return $this->hasMany(Objectif::class);
    }

    public function langues(): BelongsToMany
    {
        return $this->belongsToMany(Langue::class, 'activite_langues');
    }

    public function offres(): BelongsToMany
    {
        return $this->belongsToMany(Offre::class, 'offre_activites', 'activite_id', 'offre_id');
    }

    public function modalitesDePaiement(): BelongsToMany
    {
        return $this->belongsToMany(Modalite::class, 'activite_modalites');
    }

    public function parentals(): BelongsToMany
    {
        return $this->belongsToMany(Parental::class, 'reviews')
            ->withPivot('rating', 'description');
    }

    public function demandes():BelongsToMany
    {
        return $this->belongsToMany(Demande::class, 'demande_activite_enfants');
    }

    public function enfants_activite():BelongsToMany
    {
        return $this->belongsToMany(Enfant::class, 'demande_activite_enfants');
    }

}
