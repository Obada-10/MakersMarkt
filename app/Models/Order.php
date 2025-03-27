<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'basket_id', 'status', 'status_description', 'email',
        'postal_code', 'address', 'street_name', 'city', 'total_price'
    ];
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }

   
}

