<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'link', 'image', 'description', 'prioty', 'position'];

    // thiết lập quan hệ 1 nhiều 
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
        //category_id khóa ngoại của bảng product
        //id là khóa của bảng category
    }

    public function scopeGetBanner($q, $pos = 'top-banner')
    {
        $q = $q->where('position', $pos)->where('status', 1)->orderBy('prioty', 'ASC');
        return $q;
    }
}
