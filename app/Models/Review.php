<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    // Review hoort bij een user (koper)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Review hoort bij een product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
