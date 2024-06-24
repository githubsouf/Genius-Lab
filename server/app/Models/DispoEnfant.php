<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispoEnfant extends Model
{
    use HasFactory;
    protected $fillable = ['enfant_id', 'horaire_id', 'disponible'];
}
