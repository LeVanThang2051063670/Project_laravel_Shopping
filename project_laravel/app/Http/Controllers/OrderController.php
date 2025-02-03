<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\WarehouseTransaction;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $status = request('status', 1);
        $orders = Order::orderBy('id', 'DESC')->where('status', $status)->paginate();
        return view('admin.order.index', compact('orders'));
    }
    // public function create()
    // {
    //     $products = Product::all();

    //     foreach ($products as $product) {
    //         $product->warehouseTransactions = WarehouseTransaction::where('product_id', $product->id)
    //             ->where('transaction_type', 'import') // Chỉ lấy mã sản phẩm nhập kho
    //             ->get();
    //     }
    //     return view('admin.order.create', compact('products'));
    // }
    public function create()
    {
        // Lấy tất cả sản phẩm
        // $products = Product::all();


        $products = Product::with('warehouseTransactions')->get();
        foreach ($products as $product) {
            $product->warehouseTransactions = $product->warehouseTransactions->map(function ($transaction) {
                // Chuyển đổi import_code thành mảng nếu chưa phải là mảng
                if (!is_array($transaction->import_code)) {
                    $transaction->import_code = explode(',', $transaction->import_code); // Tách thành mảng nếu cần
                }
                return $transaction;
            });
        }


        // Trả về view và truyền dữ liệu sản phẩm
        return view('admin.order.create', compact('products'));
    }


    public function store(Request $request)
    {
        //dd($request);
        // Validate input
        //dd($request);
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'customer_address' => 'required',

        ]);
        //dd($request);

        // Tạo token đơn hàng
        //$token = Str::random(50);

        //Tạo đơn hàng mới
        $order = Order::create([
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'phone' => $request->customer_phone,
            'address' => $request->customer_address,
            'customer_id' => $request->customer_id ?? null, // Nếu không có customer_id, lưu null
            'status' => 2, // Giả sử trạng thái 1"

        ]);
        $cart = json_decode($request->cart_data, true);
        $total = 0;
        //dd($cart);
        foreach ($cart as $item) {
            $total += $item['subtotal'];

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
            $warehouseTransactions = WarehouseTransaction::where('product_id', $item['product_id'])->get();
            foreach ($warehouseTransactions as $transaction) {

                if (is_string($transaction->import_code)) {
                    $importCodes = explode(',', $transaction->import_code);
                } else {
                    // Nếu không phải chuỗi, xử lý trường hợp này
                    $importCodes = $transaction->import_code; // Có thể giữ nguyên nếu là mảng
                }

                // Tách `import_code` của warehouse thành mảng
                //$importCodes = explode(',', $transaction->import_code);

                // Tách `product_code` từ `$cart` thành mảng
                $productCodes = explode(',', $item['product_code']);

                // Tìm các `import_code` trùng với `product_code`
                $matchedCodes = array_intersect($importCodes, $productCodes);

                if (!empty($matchedCodes)) {
                    // Xóa các `import_code` đã khớp khỏi `warehouse_transactions`
                    $remainingCodes = array_diff($importCodes, $matchedCodes);

                    // Cập nhật lại `import_code` và số lượng
                    $transaction->import_code = implode(',', $remainingCodes);
                    $transaction->quantity -= $item['quantity'];

                    // Kiểm tra để không lưu số lượng âm
                    if ($transaction->quantity < 0) {
                        throw new \Exception("Số lượng kho không đủ để xử lý đơn hàng.");
                    }
                    $transaction->save();
                    // Cập nhật số lượng trong bảng products
                    // $product = Product::find($item['product_id']);
                    // if ($product) {
                    //     $product->quantity -= $item['quantity'];

                    //     // Kiểm tra để không lưu số lượng âm
                    //     if ($product->quantity < 0) {
                    //         throw new \Exception("Số lượng sản phẩm không đủ để xử lý đơn hàng.");
                    //     }

                    //     $product->save();
                    // }
                    break;
                }
            }

            //dd($warehouseTransactions);
        }
        // dd($order);

        return redirect()->route('order.create')->with('ok', 'Đơn hàng đã được tạo thành công.');
    }
    public function show(Order $order)
    {
        // $auth = $order->customer;

        // return view('admin.order.detail', compact('auth', 'order'));
        // Kiểm tra nếu $order->customer tồn tại
        $auth = $order->customer ?? null;

        // Truyền dữ liệu vào view
        if ($auth) {
            return view('admin.order.detail', compact('auth', 'order'));
        }

        // Chỉ truyền $order nếu không có $auth
        return view('admin.order.detail', compact('order'));
    }
    public function update(Order $order)
    {
        $status = request('status', 1);
        if ($order->status != 2) {
            $order->update(['status' => $status]);


            return redirect()->route('order.index')->with('ok', 'Đã xác nhận đơn hàng');
        }
        return redirect()->back()->with('no', 'Không thể cập nhật đơn hàng đã giao');


    }
}
