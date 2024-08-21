@extends('master.admin')

@section('title', 'Create new product')
@section('main')

    <div class="row">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Product name</label>
                    <input name="name" type="text" class="form-control" id="" placeholder="Input field">
                </div>
                <div class="form-group">
                    <label for="">Product description</label>
                    <textarea name="description" class="form-control description " placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Product other image</label>
                    <input name="other_img[]" type="file" class="form-control" multiple onchange="showOtherImage(this)">
                    <hr>
                    <div class="row" id="show_other_img">

                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Product category</label>
                    <select name="category_id" class="form-control" id="">
                        <option value="">Choose one</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="">Product price</label>
                    <input name="price" type="text" class="form-control" id="" placeholder="Input field">
                </div>
                <div class="form-group">
                    <label for="">Product Sale_price</label>
                    <input name="sale_price" type="text" class="form-control" id="" placeholder="Input field">
                </div>


                <div class="form-group">
                    <label for="">Product Status</label>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="1">
                            Publish
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="0">
                            Hidden
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Product image</label>
                        <input name="img" type="file" class="form-control" onchange="showImage(this)">
                        <img id="show_img" src="" alt="" width="100%">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save">Save</i></button>
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
