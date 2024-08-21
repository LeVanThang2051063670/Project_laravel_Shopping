<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'product_id', 'price', 'quantity'];

    // thiết lập quan hệ 1 nhiều 
    public $timestamps = false;

    public function prod()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
