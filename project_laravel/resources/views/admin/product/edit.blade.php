@extends('master.admin')

@section('title', 'Sửa sản phẩm ' . $product->name)
@section('main')

    <div class="row">
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input name="name" type="text" class="form-control" value="{{ $product->name }}"
                        placeholder="Input field">
                    @error('name')
                        <small class="help-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Chi tiết sản phẩm</label>
                    <textarea name="description" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
                    @error('description')
                        <small class="help-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Ảnh sản phẩm thêm</label>
                    <input name="other_img[]" type="file" class="form-control" multiple placeholder="Input field"
                        onchange="showOtherImage(this)">
                    <hr>
                    <div class="row">
                        @foreach ($product->images as $img)
                            <div class="col-md-3" style="position: relative">
                                <a href="" class="thumbnail">
                                    <img src="uploads/product/{{ $img->image }}" alt="">
                                    <a onclick="return confirm('Are you sure delele it ?')"
                                        href="{{ route('product.destroyImage', $img->id) }}" class="btn btn-sm btn-danger"
                                        style="position: absolute; top:5px;right:20px">
                                        <i class="fa fa-trash"></i>
                                    </a>

                            </div>
                        @endforeach

                    </div>
                    <h4>Các ảnh mới chọn sẽ thay thế ảnh cũ trước đó</h4>
                    <div class="row" id="show_other_img">

                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Danh mục </label>
                    <select name="category_id" class="form-control" id="">
                        <option value="">Chọn một</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}"{{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="help-block text-danger">{{ $message }}</small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="">Giá sản phẩm</label>
                    <input name="price" type="text" class="form-control" value="{{ $product->price }}"
                        placeholder="Input field">
                    @error('price')
                        <small class="help-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giá sale</label>
                    <input name="sale_price" type="text" class="form-control" value="{{ $product->sale_price }}"
                        placeholder="Input field">
                    @error('sale_price')
                        <small class="help-block text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Trạng Thái</label>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="1"
                                {{ $product->status == 1 ? 'checked' : '' }}>
                            Publish
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="0"
                                {{ $product->status == 0 ? 'checked' : '' }}>
                            Hidden
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh sản phẩm</label>
                        <input name="img" type="file" class="form-control" id="" placeholder="Input field"
                            onchange="showImage(this)">
                        @error('img')
                            <small class="help-block text-danger">{{ $message }}</small>
                        @enderror
                        <img src="uploads/product/{{ $product->image }}" width="100%" id="show_img">

                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save">Lưu</i></button>
            </div>
        </form>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()
@section('js')
    <script src="ad_assets/plugins/summernote/summernote.min.js"></script>
    <script>
        $('.description').summernote({
            height: 250
        });

        // chọn vào sẽ hiện ảnh lên (th lay ra 1 anh) 
        function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#show_img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        //lay nhieu anh
        function showOtherImage(input) {
            if (input.files && input.files.length) {
                //console.log(input.files.length);
                var _html = '';
                for (let i = 0; i < input.files.length; i++) {
                    var file = input.files[i];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        _html += `
                    <div class="thumbnail col-md-3 ">
                        <img src="${e.target.result}" alt="" width="100%">
                    </div>
                    `;
                        //console.log(_html);
                        $('#show_other_img').html(_html)

                    };

                    reader.readAsDataURL(file);

                }

            }
        }
    </script>

@stop()
