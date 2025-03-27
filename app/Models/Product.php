<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    Use HasFactory;
    protected $table = 'products';
    protected $fillable = ['user_id', 'name', 'description', 'category ', 'material', 'production_time', 'complexity', 'unique_features', 'price'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
