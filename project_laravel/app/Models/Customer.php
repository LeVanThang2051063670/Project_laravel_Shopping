<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'gender'
    ];

    // auth là cus , liên hệ với cart thông qua customer_id
    // hàm này sẽ lấy được thông tin giỏ hàng của người dùng hiện tại đnăgn nhập
    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id')->orderBy('id', 'DESC');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'customer_id', 'id');
    }

}
