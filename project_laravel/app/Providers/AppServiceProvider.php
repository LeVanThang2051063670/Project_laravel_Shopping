<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    // public function boot(): void
    // {
    //     //
    // }

    // toi vua cmt hame tren , va tao ra hame nay 
    // sử dụng phương thức redirectUsing trong AppServiceProvider hoặc một nơi khác trong ứng dụng của bạn
    //  bạn có thể thay đổi hành vi mặc định của middleware auth mà không cần sửa đổi trực tiếp mã nguồn của Laravel.

    public function boot()
    {
        //Authenticate::redirectUsing(): Chỉ thực hiện việc thay đổi đường dẫn redirect, nhưng không kết thúc hàm boot().
        // Thay đổi hành vi mặc định của middleware auth
        Authenticate::redirectUsing(function ($request) {
            return route('admin.login'); // Đường dẫn bạn muốn chuyển hướng đến
        });


        // Sử dụng View Composer để truyền biến $cats_home vào view 'master.main'
        // view()->composer('master.main', function ($view)
        // con neu dung * thi truyen tat ca vao view
        view()->composer('*', function ($view) {
            $cats_home = Category::orderBy('name', 'ASC')->where('status', 1)->get();
            $carts = Cart::where('customer_id', auth('cus')->id())->get();
            $view->with(compact('cats_home', 'carts'));
        });
    }
}
