<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispoAnimateur extends Model
{
    use HasFactory;
    protected $fillable = ['animateur_id', 'horaire_id', 'disponible'];
}
