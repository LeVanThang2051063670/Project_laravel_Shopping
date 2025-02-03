@extends('master.admin')

@section('title', 'Quản lý đơn hàng')
@section('main')
    <form action="" method="POST" class="form-inline" role="form">

        {{-- <div class="form-group">
            <label class="sr-only" for="">label</label>
            <input type="email" class="form-control" id="" placeholder="Input field">
        </div>



        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button> --}}
        <a href="{{ route('product.discount') }}" class="btn btn-success pull-right"><i class="fa fa-plus ">Thêm giảm
                giá</i></a>
        <a href="{{ route('product.create') }}" class="btn btn-success pull-right" style="margin-right: 2px"><i
                class="fa fa-plus ">Thêm mới</i></a>

    </form>

    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Mã sản phẩm</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $model)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->cat->name }}</td>
                    <td>{{ $model->id }}</td>
                    <td>{{ $model->price }} <span class="label label-success">{{ $model->sale_price }}</span></td>
                    <td>{{ $model->status == 0 ? 'Hidden' : 'Publish' }}</td>
                    <td><img src="uploads/product/{{ $model->image }}" width="40" alt=""></td>
                    <td>{{ $model->quantity }}</td>
                    <td class="text-right">
                        <form action="{{ route('product.destroy', $model->id) }}" method="post"
                            onsubmit="return confirm('Are you sure wanto delete it ?')">
                            @csrf @method('DELETE')
                            <a href="{{ route('product.edit', $model->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-edit"></i>Sửa</a>
                            <button href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Xóa</button>
                        </form>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>



@endsection
