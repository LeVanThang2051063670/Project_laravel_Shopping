<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Mail;
use App\Mail\OrderMail;
use App\Models\WarehouseTransaction;
use Illuminate\Support\Facades\DB;



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
        if (!$order) {
            return abort(404);
        }

        DB::beginTransaction();
        try {
            $order->status = 1;
            $order->token = null;
            $order->save();

            foreach ($order->details as $detail) {
                $product = $detail->product;

                // Kiểm tra số lượng sản phẩm
                if ($product->quantity < $detail->quantity) {
                    throw new \Exception('Số lượng sản phẩm không đủ để thực hiện đơn hàng!');
                }

                $remainingQuantity = $detail->quantity; // Số lượng cần xử lý

                // Lấy các giao dịch kho liên quan đến sản phẩm
                $warehouseTransactions = WarehouseTransaction::where('product_id', $detail->product_id)
                    ->orderBy('created_at', 'asc') // Ưu tiên FIFO
                    ->get();

                //dd($warehouseTransactions);

                foreach ($warehouseTransactions as $transaction) {
                    if ($remainingQuantity <= 0)
                        break;
                    $a = $transaction->import_code;
                    //dd(gettype($transaction->import_code), $transaction->import_code);

                    // Tách mã import_code thành mảng
                    //$importCodes = explode(',', $transaction->import_code);

                    if (is_array($transaction->import_code)) {
                        $importCodes = $transaction->import_code;
                    } elseif (is_string($transaction->import_code)) {
                        // Nếu import_code là chuỗi, chuyển thành mảng bằng explode
                        $importCodes = explode(',', $transaction->import_code);
                    } else {
                        dd('Dữ liệu không hợp lệ', $transaction->import_code);
                    }

                    // Chọn ngẫu nhiên các mã import_code
                    $usedCodes = [];
                    while ($remainingQuantity > 0 && count($importCodes) > 0) {
                        $randomKey = array_rand($importCodes); // Chọn mã ngẫu nhiên
                        $usedCodes[] = $importCodes[$randomKey];
                        unset($importCodes[$randomKey]); // Xóa mã đã sử dụng
                        $remainingQuantity--;
                    }

                    // Cập nhật lại import_code và quantity trong warehouse_transactions
                    $transaction->import_code = implode(',', $importCodes);
                    $transaction->quantity -= count($usedCodes);

                    if ($transaction->quantity < 0) {
                        throw new \Exception('Không đủ hàng trong kho để thực hiện đơn hàng!');
                    }

                    $transaction->save();
                }

                // Kiểm tra nếu vẫn còn số lượng cần xử lý mà không đủ giao dịch kho
                if ($remainingQuantity > 0) {
                    throw new \Exception('Không đủ hàng trong kho để thực hiện đơn hàng!');
                }

                // Cập nhật lại số lượng sản phẩm trong bảng products
                $product->quantity -= $detail->quantity;
                $product->save();
            }

            DB::commit();
            return redirect()->route('home.index')->with('ok', 'Đơn hàng đã được xác nhận thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home.index')->with('no', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }

}
