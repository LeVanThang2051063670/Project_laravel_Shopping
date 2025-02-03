<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WarehouseTransaction;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;





use App\Http\Controllers\Controller;
class WarehouseController extends Controller
{
    public function index()
    {
        $transactions = WarehouseTransaction::with('product')->latest()->get();
        return view('admin.warehouse.index', compact('transactions'));
    }
    public function show(string $id)
    {

        $warehouseTransaction = WarehouseTransaction::with('product')->findOrFail($id);



        // Giải mã nếu import_code là chuỗi JSON
        //$importCodeString = $warehouseTransaction->import_code ? json_decode($warehouseTransaction->import_code) : [];
        $importCodes = $warehouseTransaction->import_code;
        //dd($importCodes, gettype($importCodes));


        // Nếu import_code là chuỗi JSON, giải mã nó thành mảng
        // if (is_string($importCodes)) {
        //     $importCodes = json_decode($importCodes, true);
        // }
        if (is_string($importCodes)) {
            $importCodes = [$importCodes]; // Chuyển chuỗi thành mảng
        }




        return view('admin.warehouse.show', compact('warehouseTransaction', 'importCodes'));

    }
    public function exportPdf($id)
    {
        $warehouseTransaction = WarehouseTransaction::with('product')->findOrFail($id);

        $pdf = PDF::loadView('admin.warehouse.showPdf', compact('warehouseTransaction'));
        return $pdf->download('warehouse_transaction_' . $warehouseTransaction->id . '.pdf');
    }

    // Hiển thị form chung cho nhập/xuất
    public function create()
    {
        $products = Product::all(); // Lấy danh sách sản phẩm
        return view('admin.warehouse.create', compact('products'));
    }


    // Xử lý nhập/xuất hàng
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:import,export', // Nhập hoặc xuất
            'cost_price' => 'nullable|numeric|min:0', // Chỉ dùng cho nhập
            'note' => 'nullable|string|max:255',
            'expiration_date' => 'nullable|date|after_or_equal:today',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->transaction_type === 'import') {
            // Xử lý nhập hàng
            $product->increment('quantity', $request->quantity);

            // Lưu giao dịch nhập kho
            //dd($request->expiration_date);
            // for ($i = 0; $i < $request->quantity; $i++) {
            //     $importCode = 'IMP-' . Str::random(4) . '-' . now()->format('Ymd');

            //dd($importCode);

            $a = WarehouseTransaction::create([
                'product_id' => $product->id,
                'transaction_type' => 'import',
                'quantity' => $request->quantity,
                'cost_price' => $request->cost_price,
                'note' => $request->note ?? 'Nhập hàng',
                'expiration_date' => $request->expiration_date,
                'import_code' => $this->generateImportCodes($request->quantity),
                'quantity_import' => $request->quantity,
            ]);
            // dd($a);
        }


        return redirect()->route('warehouse.index')->with('ok', 'Nhập hàng thành công!');
        //}


    }
    private function generateImportCodes($quantity)
    {
        $codes = [];
        for ($i = 0; $i < $quantity; $i++) {
            $codes[] = 'IMP-' . Str::random(4) . '-' . now()->format('Ymd');
        }
        return $codes; // Trả về mảng mã
    }
    public function edit(WarehouseTransaction $warehouseTransaction)
    {
        $products = Product::all(); // Lấy danh sách sản phẩm để hiển thị trong dropdown
        // dd($warehouseTransaction);
        return view('admin.warehouse.edit', compact('warehouseTransaction', 'products'));
    }


    public function update(Request $request, WarehouseTransaction $warehouseTransaction)
    {


    }


    public function destroy($id)
    {
        // $product = Product::findOrFail($warehouseTransaction->product_id);
        // $product->decrement('quantity', $warehouseTransaction->quantity);

        // if ($warehouseTransaction->transaction_type === 'import') {

        //     $product->decrement('quantity', $warehouseTransaction->quantity);
        // }

        // Xóa giao dịch
        // dd($warehouseTransaction);
        // $warehouseTransaction->delete();
        $warehouseTransaction = WarehouseTransaction::findOrFail($id);
        $product = $warehouseTransaction->product;
        if ($warehouseTransaction->transaction_type === 'import') {

            $product->decrement('quantity', $warehouseTransaction->quantity);

        }
        $warehouseTransaction->delete();


        return redirect()->route('warehouse.index')->with('ok', 'Xóa giao dịch thành công và cập nhật số lượng sản phẩm!');
    }



}
