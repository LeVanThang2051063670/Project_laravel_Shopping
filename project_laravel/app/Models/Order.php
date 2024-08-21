<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['totalPrice'];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'customer_id',
        'status',
        'token'
    ];
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function getTotalPriceAttribute()
    {
        $t = 0;
        foreach ($this->details as $item) {
            $t += $item->price * $item->quantity;
        }
        return $t;
    }



}
