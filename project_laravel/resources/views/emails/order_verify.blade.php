<div>
    <h3>hi {{ $order->customer->name }}</h3>

    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta molestias nam eum quaerat rem dolor iure odio,
        tempora accusamus maxime laudantium! Maiores sapiente debitis numquam possimus rem officia dicta non.

    </p>
    <h4>
        Your Order detail
    </h4>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>STT</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub Total</th>
        </tr>
        <?php
        $total = 0;
        ?>
        @foreach ($order->details as $detail)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->price }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->price * $detail->quantity) }}</td>
            </tr>

            <?php
            $total += $detail->price * $detail->quantity;
            ?>
        @endforeach
        <tr>
            <th colspan="4">Total price</th>
            <th>{{ number_format($total) }}</th>
        </tr>

    </table>
    <p><a href="{{ route('order.verify', ['token' => $token]) }}">Click here to verify order</a></p>
</div>
