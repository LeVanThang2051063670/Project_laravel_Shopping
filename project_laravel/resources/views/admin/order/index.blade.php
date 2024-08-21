@extends('master.admin')

@section('main')
    <!-- main-area -->

    <main>


        <section class="contact-area">

            <div class="contact-wrap">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Order date</th>
                                <th>Status</th>
                                <th>Total Price</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span>Chua xac nhan qua email</span>
                                        @elseif($item->status == 1)
                                            <span>Đã xác nhận đơn hàng</span>
                                        @elseif($item->status == 2)
                                            <span>Đã thanh toán</span>
                                        @else
                                            <span>Đã Hủy</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->totalPrice) }}</td>


                                    <td>

                                        <a href="{{ route('order.show', $item->id) }}"
                                            class="btn btn-sm btn-primary">Detail</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
