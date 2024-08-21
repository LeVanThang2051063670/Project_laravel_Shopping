@extends('master.admin')

@section('title', 'Create new category')
@section('main')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('category.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" name="name" id="" placeholder="Input field">
                </div>

                <div class="form-group">
                    <label for="">Category Status</label>

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
                </div>


                <button type="submit" class="btn btn-primary"><i class="fa fa-save">Save</i></button>
            </form>
        </div>
    </div>


@endsection
