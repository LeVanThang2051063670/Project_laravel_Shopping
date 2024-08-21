@extends('master.admin')

@section('title', 'Edit Categories')
@section('main')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('category.update', $category->id) }}" method="POST" role="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')



                <div class="form-group">
                    <label for="">Category name</label>
                    <input name="name" value="{{ $category->name }}" type="text" class="form-control" id=""
                        placeholder="Input field">
                </div>

                <div class="form-group">
                    <label for="">Category Status</label>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="1"
                                {{ $category->status == 1 ? 'checked' : '' }}>
                            Publish
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="0"
                                {{ $category->status == 0 ? 'checked' : '' }}>
                            Hidden
                        </label>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary"><i class="fa fa-edit">Update</i></button>
            </form>
        </div>
    </div>


@endsection
