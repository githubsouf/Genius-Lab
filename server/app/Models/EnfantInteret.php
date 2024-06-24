<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnfantInteret extends Model
{
    use HasFactory;

    protected $fillable = ['enfant_id', 'service_id'];
    
}
