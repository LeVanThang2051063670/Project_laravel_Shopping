@extends('master.admin')

@section('title', 'Category Manager')
@section('main')
    <form action="" method="POST" class="form-inline" role="form">

        <div class="form-group">
            <label class="sr-only" for="">label</label>
            <input type="email" class="form-control" id="" placeholder="Input field">
        </div>



        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        <a href="{{ route('category.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus ">Add new</i></a>
    </form>

    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Category Name</th>
                <th>Category Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cats as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->status == 0 ? 'Hidden' : 'Publish' }}</td>
                    <td class="text-right">
                        <form action="{{ route('category.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-edit"></i>Edit</a>
                            <button href="" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure delete ?')"><i class="fa fa-trash"></i>Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
