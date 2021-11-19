@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <b>Categories</b>
            <a href="{{ route('categories.create') }}" class="btn btn-success float-right">Add Category</a>
        </div>
        <div class="card-body">
            @if ($categories->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                   @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>

            @else
                <h3 class="text-center text-bold">No record found</h3>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteCategory">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <p class="text-center text-bold">
                            Are you sure?
                        </p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function handleDelete($id)
        {
            var form =document.getElementById('deleteCategory')
            form.action = '/categories/'+$id
            //console.log(form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
