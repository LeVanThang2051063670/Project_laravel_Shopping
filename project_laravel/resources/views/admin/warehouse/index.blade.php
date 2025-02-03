@extends('master.admin')

@section('title', 'Nhập Hàng')

@section('main')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-filter {
            margin-bottom: 15px;
            display: flex
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Nhập Hàng</h2>
            </div>
            <div class="card-body">
                <!-- Nút lọc danh sách chỉ giữ lại "Nhập" -->
                <div class="btn-group btn-filter" role="group">
                    <button class="btn btn-outline-success" onclick="filterTransactions('import')">Nhập</button>
                    <a href="{{ route('warehouse.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i>
                        Thêm</a>
                </div>

                <!-- Bảng hiển thị giao dịch nhập kho -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng còn</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Note</th>
                                <th scope="col">Ngày nhập</th>
                                <th scope="col">Ngày hết hạn</th>
                                <th scope="col">Số lượng đã nhập</th>




                            </tr>
                        </thead>
                        <tbody id="transactionTableBody">
                            @foreach ($transactions as $transaction)
                                @if ($transaction->transaction_type === 'import')
                                    <!-- Chỉ hiển thị giao dịch nhập -->
                                    <tr class="transaction-row"
                                        data-transaction-type="{{ $transaction->transaction_type }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $transaction->product->name }}</td>
                                        <td>{{ $transaction->quantity }}</td>
                                        <td>{{ number_format($transaction->cost_price) }} đ</td>
                                        <td>{{ $transaction->note ?? 'Không có' }}</td>
                                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $transaction->expiration_date->format('d/m/Y') }}</td>
                                        <td>{{ $transaction->quantity_import }}</td>

                                        <!-- Hiển thị ngày nhập -->
                                        <td class="text-right">
                                            <form action="{{ route('warehouse.destroy', $transaction->id) }}"
                                                method="post"
                                                onsubmit="return confirm('Are you sure you want to delete it?')">
                                                @csrf @method('DELETE')
                                                <a href="{{ route('warehouse.show', $transaction->id) }}"
                                                    class="btn btn-primary">Chi Tiết</a>
                                                <button href="" class="btn  btn-danger"><i
                                                        class="fa fa-trash"></i>Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hàm lọc các giao dịch nhập kho
        function filterTransactions(type) {
            const rows = document.querySelectorAll('.transaction-row');
            rows.forEach(row => {
                const transactionType = row.getAttribute('data-transaction-type');
                if (transactionType === type) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection
