<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Mail;
use App\Mail\OrderMail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $auth = auth('cus')->user();
        return view('home.checkout', compact('auth'));
    }
    public function history()
    {
        $auth = auth('cus')->user();

        return view('home.history', compact('auth'));
    }
    public function detail(Order $order)
    {
        $auth = auth('cus')->user();

        return view('home.detail', compact('auth', 'order'));
    }
    public function post_checkout(Request $req)
    {
        $auth = auth('cus')->user();

        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'


        ], [
            'name.required' => 'Họ tên không được để trống,',
            'email.required' => 'email không được để trống,',
            'phone.required' => 'số điện thoại không được để trống,',
            'address.required' => 'Địa chỉ không được để trống,',

        ]);

        $data = $req->only('name', 'email', 'phone', 'address');
        $data['customer_id'] = $auth->id;
        if ($order = Order::create($data)) {
            $token = \Str::random(40);

            foreach ($auth->carts as $cart) {
                $data1 = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity
                ];

                OrderDetail::create($data1);

            }
            //xoa gio hang sau khi dat hang
            //$auth->carts()->delete();

            //gui mail xac nhan 
            $order->token = $token;
            $order->save();
            Mail::to($auth->email)->send(new OrderMail($order, $token));
            return redirect()->route('home.index')->with('ok', 'order checkout successfully, please check mail to continue');
        }
        return redirect()->back()->with('no', 'something error');

    }
    //khi kich vao verify email se goi den ham nay
    public function verify($token)
    {
        $order = Order::where('token', $token)->first();
        if ($order) {
            $order->status = 1;
            $order->token = null;
            $order->save();
            return redirect()->route('home.index')->with('ok', 'order verify successfully');

        }
        return abort(404);




    }
}
