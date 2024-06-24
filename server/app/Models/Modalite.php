<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalite extends Model
{
    use HasFactory;

    public function activites()
    {
        return $this->belongsToMany(Activite::class, 'activite_modalites');
    }
}
