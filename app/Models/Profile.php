<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    

    // Voeg user_id toe aan de fillable array
    protected $fillable = [
        'user_id',
        'bio',
        'profile_picture', // eventueel andere velden die je toevoegt
        'name',
    ];


    public function user()
{
    return $this->belongsTo(User::class);
}
}
