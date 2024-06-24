<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Langue extends Model
{
    use HasFactory;

    public function animateurs():BelongsToMany
    {
        return $this->belongsToMany(Animateur::class, 'langue_animateurs');
    }

    public function activites():BelongsToMany
    {
        return $this->belongsToMany(Activite::class, 'activite_langues');
    }
}
