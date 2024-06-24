<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['animateur_id', 'title', 'country', 'city', 'company', 'statut', 'start_date', 'end_date', 'description'];
    
    public function animateur(): BelongsTo
    {
        return $this->belongsTo(Animateur::class);
    }
}
