@extends('master.admin')
@section('title', 'Thống kê')
@section('main')
    <style>
        .chart-container {
            width: 75%;
            margin: 0 auto;
            /* Căn giữa */
        }

        canvas {
            width: 100%;
            /* Đảm bảo biểu đồ chiếm hết diện tích container */
            height: 400px;
            /* Cố định chiều cao */
        }

        .table-style {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        .table-style th,
        .table-style td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table-style th {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }

        .table-style tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-style tr:hover {
            background-color: #ddd;
        }

        .table-style td {
            font-size: 14px;
            color: #555;
        }

        /* Định dạng số tiền */
        .table-style td {
            text-align: right;
        }

        .table-style td,
        .table-style th {
            padding: 10px 20px;
        }

        /* Điều chỉnh kiểu chữ và màu sắc */
        .table-style td,
        .table-style th {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .table-style th {
            font-weight: bold;
        }
    </style>

    <body>
        <h1>Thống kê</h1>

        <!-- Bộ lọc -->
        <form method="get" action="{{ route('dashboard') }}">
            <label for="start_date">Ngày bắt đầu:</label>
            <input type="date" id="start_date" name="start_date" value="{{ $startDate }}">
            <label for="end_date">Ngày kết thúc:</label>
            <input type="date" id="end_date" name="end_date" value="{{ $endDate }}">
            <button type="submit">Lọc</button>
        </form>

        <!-- Biểu đồ Số đơn hàng -->
        <h2>Số đơn hàng</h2>
        <div class="chart-container">
            <canvas id="ordersChart"></canvas>
        </div>

        <!-- Biểu đồ Doanh thu -->
        <h2>Doanh thu</h2>
        <div class="chart-container">
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Biểu đồ Nhập/Xuất kho -->
        <h2>Số đơn nhập</h2>
        <div class="chart-container">
            <canvas id="transactionsChart"></canvas>
        </div>
        <!-- Bảng Doanh thu và Lợi nhuận -->
        <h2>Doanh thu và Lợi nhuận</h2>

        <table class="table-style">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Doanh thu bán hàng</th>
                    <th>Chi phí nhập</th>
                    <th>Lợi nhuận</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dates as $date)
                    <tr>
                        <td>{{ $date }}</td>
                        <td>{{ number_format($revenueData[$date]) }} VND</td>
                        <td>{{ number_format($importRevenue[$date]) }} VND</td>
                        <td>{{ number_format($profitData[$date]) }} VND</td>

                    </tr>
                @endforeach
            </tbody>
        </table>



        <script>
            // Biểu đồ số đơn hàng
            const ordersChart = new Chart(document.getElementById('ordersChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'Orders',
                        data: @json($ordersData->values()),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Đảm bảo số lượng đơn hàng là số nguyên
                                precision: 0 // Đảm bảo không có số thập phân
                            }
                        }
                    }
                }
            });

            // Biểu đồ doanh thu
            const revenueChart = new Chart(document.getElementById('revenueChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'Revenue',
                        data: @json($revenueData->values()),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            // Biểu đồ nhập/xuất kho
            const transactionsChart = new Chart(document.getElementById('transactionsChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: @json($dates),
                    datasets: [{
                            label: 'Imports',
                            data: @json($importData->values()),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }

                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
@endsection
