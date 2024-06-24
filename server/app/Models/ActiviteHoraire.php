<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiviteHoraire extends Model
{
    use HasFactory;
    protected $fillable = ['num_seance', 'activite_id', 'horaire_id'];

    public function horaire()
{
    return $this->belongsTo(Horaire::class);
}



}
