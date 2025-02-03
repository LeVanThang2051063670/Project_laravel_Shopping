@extends('master.admin')

@section('main')
    <h3>Tạo Đơn Hàng</h3>
    <form action="{{ route('order.store') }}" method="POST" id="order-form">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h4>Thông tin khách hàng</h4>
                <div class="form-group">
                    <label for="customer_name">Họ tên</label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customer_email">Email</label>
                    <input type="email" id="customer_email" name="customer_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Phone</label>
                    <input type="text" id="customer_phone" name="customer_phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customer_address">Địa chỉ</label>
                    <input type="text" id="customer_address" name="customer_address" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <h4>Chọn Sản Phẩm</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Import Code</th>
                            <th>Id</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
                                    <select name="product[{{ $product->id }}][import_code]" class="form-control">
                                        @foreach ($product->warehouseTransactions as $transaction)
                                            @foreach ($transaction->import_code as $code)
                                                <option value="{{ $code }}"
                                                    data-quantity="{{ $transaction->quantity_import }}"
                                                    data-warehouse-id="{{ $transaction->id }}">
                                                    {{ $code }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    @foreach ($product->warehouseTransactions as $transaction)
                                        <p>{{ $transaction->id }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->warehouseTransactions as $transaction)
                                        <p warehouse-id="{{ $transaction->id }}" data-qua ="{{ $transaction->quantity }}">
                                            {{ $transaction->quantity }}</p>
                                    @endforeach
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary add-to-cart"
                                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}">Thêm</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <h4>Danh sách</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Mã code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Cart items will be dynamically added here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align: right;">Tổng Tiền:</th>
                            <th id="cart-total">0</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="cart_data" id="cart_data">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Tạo Đơn Hàng</button>
    </form>

    <style>
        /* CSS styles */
        /* Add CSS as you did before */
    </style>

    <script>
        let cart = [];

        // Hàm cập nhật UI
        function updateCartUI() {
            const cartItemsTable = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            cartItemsTable.innerHTML = '';

            let total = 0;
            cart.forEach((item, index) => {
                total += item.subtotal;

                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${item.product_name}</td>
            <td>${item.price.toLocaleString()}</td>
            <td>${item.quantity}</td>
            <td>${item.subtotal.toLocaleString()}</td>
            <td>${item.product_code}</td>
            <td>
                <button type="button" class="btn btn-danger remove-from-cart" data-index="${index}">
                    Xóa
                </button>
            </td>
        `;
                cartItemsTable.appendChild(row);
            });

            cartTotalElement.textContent = total.toLocaleString();
            document.getElementById('cart_data').value = JSON.stringify(cart);

            attachRemoveFromCartEvent();
        }

        // Gắn sự kiện cho nút "Thêm vào giỏ hàng"
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {

                //const selectedOption = selectElement.options[selectElement.selectedIndex];


                //const productId = productRow.children[3].textContent.trim();

                // const a = 5;
                // console.log(a);
                const productId = this.getAttribute('data-product-id');

                const productName = this.getAttribute('data-product-name');
                const productPrice = parseFloat(this.getAttribute('data-product-price'));

                const selectElement = this.closest('tr').querySelector('select');
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const warehouseId = selectedOption.getAttribute(
                    'data-warehouse-id'); //khi click ở select lấy ra id của nó
                //console.log(warehouseId);

                const productCode = selectedOption.value;
                const availableQuantity = parseInt(selectedOption.getAttribute('data-quantity'));
                //
                const productRow = this.closest('tr');

                const quantityTd = productRow.querySelector(
                    'td:nth-child(5)'); // Assuming quantity is in the 5th column
                const quantityElements = quantityTd.querySelectorAll('p');

                // Lưu số lượng ban đầu nếu chưa có
                let originalQuantity = parseInt(quantityElements[0].textContent);
                //console.log(originalQuantity);


                // Giảm số lượng
                if (warehouseId) {
                    quantityElements.forEach(p => {
                        let currentWarehouseId = p.getAttribute('warehouse-id');
                        //console.log(currentWarehouseId);
                        let currentQuantity = parseInt(p.textContent);
                        if (currentQuantity > 0 && currentWarehouseId === warehouseId) {
                            p.textContent = currentQuantity - 1;

                        }


                    });
                }

                //

                // if (availableQuantity <= 0) {
                //     alert('Mã import_code đã hết hàng!');
                //     return;
                // }

                const quantity = 1;
                const subtotal = productPrice * quantity;

                const existingProductIndex = cart.findIndex(item => item.product_id === productId);
                if (existingProductIndex !== -1) {
                    const existingProduct = cart[existingProductIndex];
                    const newQuantity = existingProduct.quantity + quantity;
                    existingProduct.quantity = newQuantity;
                    existingProduct.subtotal = newQuantity * productPrice;

                    if (!existingProduct.product_code.includes(productCode)) {
                        existingProduct.product_code += `, ${productCode}`;
                    }
                } else {
                    cart.push({
                        product_id: productId,
                        product_name: productName,
                        price: productPrice,
                        quantity: quantity,
                        product_code: productCode,
                        subtotal: subtotal,
                        original_quantity: originalQuantity // Lưu số lượng ban đầu
                    });
                }

                selectedOption.setAttribute('data-quantity', availableQuantity - quantity);
                selectElement.remove(selectElement.selectedIndex);

                updateCartUI();
            });
        });

        // Gắn sự kiện cho nút "Xóa khỏi giỏ hàng"
        function attachRemoveFromCartEvent() {
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const itemIndex = parseInt(this.getAttribute('data-index'));
                    const removedItem = cart.splice(itemIndex, 1)[0];

                    const productRow = [...document.querySelectorAll('tr')].find(r => {
                        const button = r.querySelector('.add-to-cart');
                        return button && button.getAttribute('data-product-id') === removedItem
                            .product_id;
                    });

                    if (productRow) {
                        const quantityTd = productRow.querySelector('td:nth-child(5)');
                        const quantityElements = quantityTd.querySelectorAll('p');


                        //console.log(quantityElements);

                        // Khôi phục số lượng ban đầu + số lượng đã giảm
                        //const originalQuantity = removedItem.original_quantity;
                        const restoredQuantity = removedItem.original_quantity;
                        quantityElements.forEach(p => {
                            // Khôi phục số lượng gốc từ data-original-quantity
                            const originalQuantity = parseInt(p.getAttribute(
                                'data-qua'));
                            console.log(originalQuantity);
                            p.textContent = originalQuantity; // Đặt lại giá trị ban đầu
                        });

                        //console.log(restoredQuantity);
                        // const originalQuantity = removedItem.original_quantity;
                        // console.log(originalQuantity);



                        // quantityElements.forEach(p => {
                        //     let currentWarehouseId = p.getAttribute('warehouse-id');
                        //     if (currentWarehouseId === removedItem.warehouse_id) {
                        //         let currentQuantity = parseInt(p.textContent);
                        //         p.textContent = originalQuantity; // Khôi phục số lượng ban đầu
                        //     }
                        // });

                        const selectElement = productRow.querySelector('select');
                        removedItem.product_code.split(', ').forEach(code => {
                            const option = document.createElement('option');
                            option.value = code;
                            option.textContent = code;
                            option.setAttribute('data-quantity', restoredQuantity);
                            selectElement.appendChild(option);
                        });
                    }

                    updateCartUI();
                });
            });
        }

        // Lần đầu tiên gọi cập nhật UI để gắn sự kiện
        updateCartUI();
    </script>
@endsection
