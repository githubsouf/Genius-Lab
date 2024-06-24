<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreActivite extends Model
{
    use HasFactory;
    protected $fillable = ['activite_id', 'offre_id', 'photo'];
}
