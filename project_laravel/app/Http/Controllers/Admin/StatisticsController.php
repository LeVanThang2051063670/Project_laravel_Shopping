<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\WarehouseTransaction;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    /**
     * Display the statistics for the selected period (day, month, year).
     */
    public function index(Request $request)
    {
        // Lấy ngày bắt đầu và ngày kết thúc từ request
        $startDate = $request->query('start_date', Carbon::now()->startOfDay()->toDateTimeString());
        // Mặc định ngày kết thúc là cuối giờ ngày hiện tại
        $endDate = $request->query('end_date', Carbon::now()->endOfDay()->toDateTimeString());
        $endDate = Carbon::parse($endDate)->endOfDay()->toDateTimeString();


        // Số đơn hàng theo ngày
        $ordersData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Doanh thu theo ngày
        $revenueData = DB::table('order_details')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->whereIn('orders.status', [1, 2]) // Trạng thái đã thanh toán
            ->selectRaw('DATE(orders.created_at) as date, SUM(order_details.quantity * order_details.price) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Nhập và xuất kho theo ngày
        $transactionData = WarehouseTransaction::selectRaw('DATE(created_at) as date, transaction_type, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date', 'transaction_type')
            ->orderBy('date')
            ->get();

        // Lấy danh sách các ngày trong khoảng thời gian
        $dates = collect();
        for ($date = strtotime($startDate); $date <= strtotime($endDate); $date = strtotime('+1 day', $date)) {
            $dates->push(date('Y-m-d', $date));
        }

        // Chuẩn hóa dữ liệu nhập/xuất kho để không thiếu ngày nào
        $importData = $dates->mapWithKeys(function ($date) use ($transactionData) {
            return [$date => $transactionData->where('date', $date)->where('transaction_type', 'import')->sum('count')];
        });

        // $exportData = $dates->mapWithKeys(function ($date) use ($transactionData) {
        //     return [$date => $transactionData->where('date', $date)->where('transaction_type', 'export')->sum('count')];
        // });
        // Chuẩn hóa dữ liệu cho số đơn hàng và doanh thu, thêm các ngày thiếu
        $ordersData = $dates->mapWithKeys(function ($date) use ($ordersData) {
            $order = $ordersData->firstWhere('date', $date);
            return [$date => (int) ($order ? $order->count : 0)];  // Chuyển số lượng đơn hàng về kiểu số nguyên
        });

        $revenueData = $dates->mapWithKeys(function ($date) use ($revenueData) {
            $revenue = $revenueData->firstWhere('date', $date);
            return [$date => (float) ($revenue ? $revenue->revenue : 0)];  // Đảm bảo doanh thu là số thực
        });

        // // lấy ra tiền xuất ngày đó
        // $exportRevenue = WarehouseTransaction::selectRaw('DATE(created_at) as date, SUM(quantity * cost_price) as export_revenue')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->where('transaction_type', 'export')
        //     ->groupBy('date')
        //     ->orderBy('date')
        //     ->get()->pluck('export_revenue', 'date');

        // lấy ra tiền nhập ngày đó
        $importRevenue = WarehouseTransaction::selectRaw('DATE(created_at) as date, SUM(quantity_import * cost_price) as import_revenue')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('transaction_type', 'import')
            ->groupBy('date')
            ->orderBy('date')
            ->get()->pluck('import_revenue', 'date');
        // chuẩn hóa để không thiếu ngày nào
        // $exportRevenue = $dates->mapWithKeys(function ($date) use ($exportRevenue) {
        //     return [$date => $exportRevenue[$date] ?? 0]; // Giá trị mặc định là 0 nếu không có dữ liệu
        // });

        $importRevenue = $dates->mapWithKeys(function ($date) use ($importRevenue) {
            return [$date => $importRevenue[$date] ?? 0]; // Giá trị mặc định là 0 nếu không có dữ liệu
        });

        //dd($importRevenue);

        // dd($importRevenue);
        // Tính lợi nhuận: (export + order revenue) - import
        $profitData = $dates->mapWithKeys(function ($date) use ($revenueData, $importRevenue) {
            $profit = $revenueData[$date] - $importRevenue[$date];
            return [$date => $profit];

        });
        //dd($importData, $exportData, $revenueData, $profitData);
        //dd($exportRevenue);
        //dd($profitData);









        // Giới hạn chỉ hiển thị tối đa 7 ngày trên biểu đồ
        $dates = $dates->take(7);
        $ordersData = $ordersData->only($dates->toArray());
        $revenueData = $revenueData->only($dates->toArray());
        $importData = $importData->only($dates->toArray());
        // $exportData = $exportData->only($dates->toArray());
        $profitData = $profitData->only($dates->toArray());
        // dd($dates, $ordersData, $revenueData, $profitData);


        return view('admin.statistic.index', compact('ordersData', 'revenueData', 'importData', 'profitData', 'importRevenue', 'dates', 'startDate', 'endDate'));
    }

}
