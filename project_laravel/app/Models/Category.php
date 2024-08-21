<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable = ['name', 'status'];

    protected $hidden = ['created_at', 'update_at'];

    // thiết lập quan hệ 1 nhiều 
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->orderBy('created_at', 'DESC');
        //category_id khóa ngoại của bảng product
        //id là khóa của bảng category
    }
}
