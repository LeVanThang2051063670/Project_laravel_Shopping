<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        //  getBanner mac dinh la top-banner
        //first thi lay 1 , con get thi lay nhieu
        $topBanner = Banner::getBanner()->first();
        $gallerys = Banner::getBanner('gallery')->get();
        // //lấy hàm GetBanner từ trong model Banner ra
        // // nhưng ở đây thì chữ đầu viết thường
        //dd($topBanner);
        //lay 2 san pham moi nhat
        $news_products = Product::orderBy('created_at', 'DESC')->limit(2)->get();
        //lay 3 cai sale moi nhat
        $sales_products = Product::orderBy('created_at', 'DESC')->where('sale_price', '>', 0)->limit(3)->get();
        //moi lan load lay ra ngau nhien 4 san pham
        $features_products = Product::inRandomOrder()->limit(4)->get();

        return view('home.index', compact('topBanner', 'gallerys', 'news_products', 'sales_products', 'features_products'));

    }
    public function about()
    {
        return view('home.about');
    }
    public function category(Category $cat)
    {
        //c1
        //$products = Product::where('category_id', $cat->id)->get();
        // dd($products);
        //c2 thiet lap quan he trong model Category
        //dd($cat->products);
        //phan trang , mot dong 9 cai
        $products = $cat->products()->paginate(9);
        $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home.category', compact('cat', 'products', 'news_products'));
    }
    public function product(Product $product)
    {
        //truy van san pham lien quan
        $products = Product::where('category_id', $product->category_id)->limit(12)->get();
        return view('home.product', compact('product', 'products'));
    }
    public function favorite($product_id)
    {

        $data = [
            'product_id' => $product_id,
            'customer_id' => auth('cus')->id()

        ];

        $favorited = Favorite::where(['product_id' => $product_id, 'customer_id' => auth('cus')->id()])->first();
        if ($favorited) {
            $favorited->delete();
            return redirect()->back()->with('ok', 'bạn đã bo thich thanh cong');
        } else {
            Favorite::create($data);
            return redirect()->back()->with('ok', 'bạn đã yêu thích sản phẩm');
        }


    }

}
