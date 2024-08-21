<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $appends = ['favorited'];
    protected $fillable = ['name', 'status', 'price', 'sale_price', 'image', 'category_id', 'description'];

    // thiết lập quan hệ 1 -1(1 san pham co mot danh muc)
    public function cat()
    {
        //từ sản phẩm muốn đến cat thì ta có hasOne
        return $this->hasOne(Category::class, 'id', 'category_id');
        //id của category tham chiếu đến category_id của product
    }
    //thiet lap quan he 1 nhieu ( 1 san pham co nhieu anh)
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function getFavoritedAttribute()
    {
        $favorited = Favorite::where(['product_id' => $this->id, 'customer_id' => auth('cus')->id()])->first();
        return $favorited ? true : false;
    }
}
