<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Giao Dịch Kho</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }

        .info-container {
            display: flex;
            justify-content: space-between;
            /* Để các phần tử chia đều không gian */
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .store-info,
        .customer-info {
            width: 48%;
            /* Cho mỗi khối thông tin chiếm khoảng 48% chiều rộng */
        }

        .store-info strong,
        .customer-info strong {
            font-weight: bold;
        }


        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .table td {
            background-color: #fafafa;
        }

        .table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .table .total {
            font-weight: bold;
            background-color: #f8f8f8;
        }

        .table td strong {
            color: #555;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .dotted-line {
            border-bottom: 1px dotted #888;
            width: 100%;
            margin-top: 5px;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
            text-decoration: underline;
        }

        .price-column {
            width: 150px;
            text-align: right;
        }

        .customer-info {
            border-top: 2px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
        }

        .customer-info p {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Xuất hóa đơn</h1>

        <div class="info-container">
            <div class="store-info">
                <h2> ThangShop</h2><br>
                Address: Đống Đa<br>
                Phone: 0345638915<br>
                Email: thanglv229@gmail.com
            </div>

            <div class="customer-info">
                <strong>Tên khách hàng:</strong>
                <span>...........................................................</span><br>
                <strong>Số điện thoại:</strong>
                <span>...........................................................</span><br>
                <strong>Địa chỉ:</strong>
                <span>..............................................................</span><br>

            </div>
        </div>


        <div class="section-title">Sản phẩm</div>
        <table class="table">
            <tr>
                <th>Tên sản phẩm</th>
                <td>{{ $warehouseTransaction->product->name }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>{{ $warehouseTransaction->transaction_type === 'import' ? 'Nhập' : 'Xuất' }}</td>
            </tr>
            <tr>
                <th>Số lượng</th>
                <td>{{ $warehouseTransaction->quantity }}</td>
            </tr>
            <tr>
                <th>Giá</th>
                <td>{{ number_format($warehouseTransaction->cost_price, 2) }} đ</td>
            </tr>
            <tr>
                <th>Ghi chú</th>
                <td>{{ $warehouseTransaction->note ?? 'Không có' }}</td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ \Carbon\Carbon::parse($warehouseTransaction->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <div class="section-title">Tổng</div>
        <table class="table">
            <tr class="total">
                <th>Tổng</th>
                <td>{{ number_format($warehouseTransaction->quantity * $warehouseTransaction->cost_price, 2) }} đ</td>
            </tr>
        </table>


    </div>

    <div class="footer">
        <p>Cảm ơn quý khách </p>
    </div>
</body>

</html>
