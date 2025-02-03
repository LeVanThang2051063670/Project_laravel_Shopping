@extends('master.admin')

@section('title', 'Chi Tiết Giao Dịch Kho')

@section('main')
    <style>
        .card {
            margin-top: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-export-pdf {
            margin-bottom: 20px;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Chi tiết</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('warehouse.index') }}" class="btn btn-secondary mb-3">Quay lại</a>

                <!-- Nút xuất PDF -->
                <a href="{{ route('warehouse.exportPdf', $warehouseTransaction->id) }}" class="btn btn-danger btn-export-pdf">
                    <i class="fa fa-file-pdf"></i> Xuất PDF
                </a>

                <!-- Thông tin chi tiết giao dịch -->
                <table class="table table-bordered">
                    <tr>
                        <th>Mã Sản Phẩm</th>
                        <td>{{ $warehouseTransaction->product->id }}</td>
                    </tr>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <td>{{ $warehouseTransaction->product->name }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            <span
                                class="badge 
                                {{ $warehouseTransaction->transaction_type === 'import' ? 'badge-success' : 'badge-danger' }}">
                                {{ $warehouseTransaction->transaction_type === 'import' ? 'Nhập' : 'Xuất' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Số lượng</th>
                        <td>{{ $warehouseTransaction->quantity_import }}</td>
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <td>{{ number_format($warehouseTransaction->cost_price) }} đ</td>
                    </tr>
                    <tr>
                        <th>Tổng tiền</th>
                        <td>{{ number_format($warehouseTransaction->quantity_import * $warehouseTransaction->cost_price) }}
                            đ
                        </td>
                    </tr>
                    <tr>
                        <th>Ghi chú</th>
                        <td>{{ $warehouseTransaction->note ?? 'Không có ghi chú' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ \Carbon\Carbon::parse($warehouseTransaction->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Ngày hết hạn</th>
                        <td>{{ \Carbon\Carbon::parse($warehouseTransaction->expiration_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Mã nhập hàng</th>
                        <td>
                            @if (count($importCodes) > 0)
                                <ul>
                                    @foreach ($importCodes as $code)
                                        <li>{{ $code }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Không có mã nhập hàng nào.</p>
                            @endif
                        </td>
                    </tr>

                </table>
                <!-- Bảng hiển thị tất cả mã import_code -->
                {{-- @if ($importCodeString && is_array($importCodeString))
                    <h3 class="mt-5">Danh sách Mã Nhập Hàng</h3>
                    <table class="table table-bordered import-codes">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã Nhập Hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($importCodeString as $index => $code)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $code }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Không có mã nhập hàng nào.</p>
                @endif --}}
            </div>
        </div>
    </div>
@endsection
