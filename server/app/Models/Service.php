<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    public function animateurs():BelongsToMany
    {
        return $this->belongsToMany(Animateur::class)->withPivot('categorie_id');
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Categorie::class)->withPivot('animateur_id');
    }

    public function categorie():BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function enfants():BelongsToMany
    {
        return $this->belongsToMany(Enfant::class, 'enfant_interets');
    }
}
