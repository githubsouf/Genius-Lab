<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification as BaseNotification;
use Illuminate\Support\Str;

class Notification extends BaseNotification
{
    use HasFactory;

    protected $fillable = ['type', 'notifiable_id', 'notifiable_type', 'data', 'read_at', 'user_id'];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}