@extends('master.admin')

@section('title', 'Nhập Hàng')

@section('main')
    <div class="container mt-5">
        <h2 class="mb-4">Quản lý kho (Nhập hàng)</h2>

        <form action="{{ route('warehouse.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="transaction_type">Loại giao dịch</label>
                <select name="transaction_type" id="transaction_type" class="form-control" onchange="toggleCostPriceField()">
                    <option value="import" selected>Nhập</option>

                </select>
            </div>

            <div class="form-group">
                <label for="product_id">Sản phẩm</label>
                <select name="product_id" id="product_id" class="form-control" onchange="updateReferencePrice()">
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-sale-price="{{ $product->sale_price }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
            </div>

            <div class="form-group" id="costPriceField">
                <label for="cost_price">Giá nhập</label>
                <input type="number" name="cost_price" id="cost_price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group" id="referencePriceField" style="display: none;">
                <label for="reference_price">Giá tham chiếu (Giá bán)</label>
                <input type="text" id="reference_price" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="expiration_date" class="form-label">Ngày hết hạn</label>
                <input type="date" name="expiration_date" id="expiration_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea name="note" id="note" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 10px">Thực hiện</button>
        </form>
    </div>

    <script>
        function toggleCostPriceField() {
            const transactionType = document.getElementById('transaction_type').value;
            const costPriceField = document.getElementById('costPriceField');
            const referencePriceField = document.getElementById('referencePriceField');

            if (transactionType === 'export') {
                costPriceField.style.display = 'none'; // Ẩn trường giá nhập
                referencePriceField.style.display = 'block'; // Hiện trường giá tham chiếu
                updateReferencePrice();
            } else {
                costPriceField.style.display = 'block'; // Hiện trường giá nhập
                referencePriceField.style.display = 'none'; // Ẩn trường giá tham chiếu
            }
        }

        function updateReferencePrice() {
            const selectedProduct = document.getElementById('product_id').selectedOptions[0];
            const salePrice = selectedProduct.getAttribute('data-sale-price') || '0';
            document.getElementById('reference_price').value = salePrice;
        }

        // Gọi khi load trang để áp dụng logic ban đầu
        toggleCostPriceField();
    </script>

@endsection
