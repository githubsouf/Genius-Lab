<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parental extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'country', 'city', 'postal', 'address', 'province', 'photo', 'telephone', 'genre'];

    public function enfants():HasMany
    {
        return $this->hasMany(Enfant::class);
    }

    public function demandes():HasMany
    {
        return $this->hasMany(Demande::class);
    }

    public function activites():BelongsToMany
    {
        return $this->belongsToMany(Activite::class, 'reviews')
                    ->withPivot('rating', 'description');
    }
}
