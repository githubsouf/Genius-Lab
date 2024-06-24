<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animateur extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'country', 'city', 'postal', 'address', 'province', 'photo', 'telephone', 'date_naissance'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function experiences():HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function langues():BelongsToMany
    {
        return $this->belongsToMany(Langue::class, 'langue_animateurs');
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Categorie::class)->withPivot('service_id');
    }

    public function servicesMaitrises():BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'animateur_categorie_services')->withPivot('categorie_id');
    }

    public function horairesdispo():BelongsToMany
    {
        return $this->belongsToMany(Horaire::class, 'dispo_animateurs');
    }

    //les activites avec les horaires dont disposent un animateur
    public function activites():BelongsToMany
    {
        return $this->belongsToMany(Activite::class, 'animers', 'animateur_id', 'activite_id')->withPivot('horaire_id');
    }

}
