<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiviteModalite extends Model
{
    use HasFactory;
    protected $fillable = ['activite_id', 'modalite_id'];
}
