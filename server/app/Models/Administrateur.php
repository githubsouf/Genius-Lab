<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrateur extends Model
{
    protected $fillable = [
        'user_id', 'google2fa_secret', 'google2fa_enabled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
