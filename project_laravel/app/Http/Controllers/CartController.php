<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        // dem sang truyen o maser view ,truyền vào appservice provider
        // $carts = Cart::where('customer_id', auth('cus')->id())->get();
        return view('home.cart');
    }
    public function add(Product $product, Request $req)
    {

        $quantity = $req->quantity ? floor($req->quantity) : 1;
        $cus_id = auth('cus')->id();
        $cartExist = Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product->id
        ])->first();

        if ($cartExist) {
            Cart::where([
                'customer_id' => $cus_id,
                'product_id' => $product->id
            ])->increment('quantity', $quantity);
            //c1 (cap nhat lai so luong (quantity))
            //$cartExist->increment('quantity', $quantity);
            //c2
            // $cartExist->update([
            //     'quantity' => $cartExist->quantity + 1
            // ]);
            return redirect()->route('cart.index')->with('ok', 'cap nhat san pham gio hang thanh cong');

        } else {
            $data = [
                'customer_id' => auth('cus')->id(),
                'product_id' => $product->id,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => $quantity
            ];
            if (Cart::create($data)) {
                return redirect()->route('cart.index')->with('ok', 'thêm vào giỏ hàng thành công');
            }

        }
        return redirect()->back()->with('no', 'vui lòng thử lại');



    }
    public function update(Product $product, Request $req)
    {
        $quantity = $req->quantity ? floor($req->quantity) : 1;
        $cus_id = auth('cus')->id();
        $cartExist = Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product->id
        ])->first();
        if ($cartExist) {
            Cart::where([
                'customer_id' => $cus_id,
                'product_id' => $product->id
            ])->update([
                        'quantity' => $quantity
                    ]);

            return redirect()->route('cart.index')->with('ok', 'cap nhat san pham gio hang thanh cong');

        }


        return redirect()->back()->with('no', 'cập nhật không thành công');
    }
    public function delete($product_id)
    {
        $cus_id = auth('cus')->id();
        Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product_id
        ])->delete();
        return redirect()->back()->with('ok', 'xoa thành công sản phẩm khỏi giỏi hàng');
    }
    public function clear()
    {
        $cus_id = auth('cus')->id();
        Cart::where([
            'customer_id' => $cus_id

        ])->delete();
        return redirect()->back()->with('ok', 'xoa tất cả trong giỏ hàng thành công');
    }


}
