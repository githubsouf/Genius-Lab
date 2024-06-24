<?php

namespace App\Models;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    // Définition des attributs que vous pouvez assigner massivement
    protected $fillable = ['name'];

    // Relation avec le modèle Message
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relation avec le modèle User via la table pivot conversation_user
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user');
    }
}
