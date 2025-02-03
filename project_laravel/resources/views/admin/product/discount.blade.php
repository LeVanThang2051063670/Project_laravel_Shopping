@extends('master.admin')

@section('title', 'Create new discount')
@section('main')

    <form action="{{ route('product.addDiscount') }}" method="POST">
        @csrf
        <label for="discount">Nhập phần trăm giảm giá:</label>
        <input type="number" name="discount" id="discount" min="0" max="100" required>

        <fieldset>
            <legend>Chọn danh mục:</legend>
            <div>
                <input type="checkbox" id="category_all" name="categories[]" value="all">
                <label for="category_all">Tất cả</label>
            </div>
            @foreach ($categories as $category)
                <div>
                    <input type="checkbox" id="category_{{ $category->id }}" name="categories[]"
                        value="{{ $category->id }}">
                    <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                </div>
            @endforeach
        </fieldset>

        <button type="submit">Áp dụng giảm giá</button>
    </form>

    {{-- <form action="{{ route('product.addDiscount') }}" method="POST">
        @csrf
        <label for="category">Chọn danh mục:</label>
        <select name="category_id" id="category">
            <option value="all">Tất cả</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="discount">Nhập phần trăm giảm giá:</label>
        <input type="number" name="discount" id="discount" min="0" max="100" required>

        <button type="submit">Áp dụng giảm giá</button>
    </form> --}}



@endsection
@section('css')
    <link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()
