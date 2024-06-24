<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActiviteLangue extends Model
{
    use HasFactory;
    protected $fillable = ['langue_id', 'activite_id' ];
}
