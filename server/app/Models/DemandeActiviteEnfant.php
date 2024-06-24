<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeActiviteEnfant extends Model
{
    use HasFactory;
    protected $fillable = ['activite_id', 'enfant_id', 'demande_id', 'modalite'];

}
