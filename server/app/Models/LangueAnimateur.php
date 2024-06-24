<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class LangueAnimateur extends Model
{
    use HasFactory;

    protected $fillable =['langue_id', 'proficiency', 'animateur_id'];

    /*
    public function animateurs(): belongsToMany
    {
        return $this->belongsToMany(Animateur::class);
    }

    public function langues(): belongsToMany
    {
        return $this->belongsToMany(Langage::class);
    }
    */
    
    public function categories()
    {
        return $this->belongsToMany(Categorie::class)->withPivot('service_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('categorie_id');
    }
}
