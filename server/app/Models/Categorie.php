<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;

    public function animateurs():BelongsToMany
    {
        return $this->belongsToMany(Animateur::class)->withPivot('service_id');
    }

    public function servicesMaitrises():BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('animateur_id');
    }

    public function services():HasMany
    {
        return $this->hasMany(Service::class);
    }

    

}
