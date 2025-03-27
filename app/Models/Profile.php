<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Voeg de 'fillable' property toe om mass assignment te ondersteunen
    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'profile_picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
