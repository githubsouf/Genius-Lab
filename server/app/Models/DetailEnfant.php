<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEnfant extends Model
{
    use HasFactory;

    protected $table = 'detail_enfant';

    protected $fillable = [
        'enfant_id',
        'age',
        'sex',
        'domaine_prefere',
        'matiere_prefere',
    ];

    public function enfant()
    {
        return $this->belongsTo(Enfant::class);
    }
}
