<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'transaction_type',
        'quantity',
        'cost_price',
        'note',
        'expiration_date',
        'import_code',
        'quantity_import'
    ];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    protected $casts = [
        'created_at' => 'datetime',
        'expiration_date' => 'datetime',
        'import_code' => 'array',

    ];

}