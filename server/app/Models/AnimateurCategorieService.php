<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimateurCategorieService extends Model
{
    use HasFactory;
    protected $fillable = ['categorie_id', 'service_id', 'animateur_id'];
    
}
