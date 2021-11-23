@extends('layouts.app')

@section('page_name')
Caregories
@endsection

@section('content')
<div class="col-10 offset-1 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Category List Table</h6>
        @if(Auth()->user()->role == 'admin')
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Add Category</a>
        @endif
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th>Name</th>
              <th>No. of post</th>
              <th>Action</th>
            </tr>
          </thead>
          @if($categories->count() > 0)
          <tbody>
                <tbody>
                   @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->posts->count() }}</td>
                        <td>
                            @if(Auth()->user()->role == 'admin')
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})"><i class="fas fa-trash"></i></button>
                            @endif
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
                            Are you sure to delete {{$category->name}}?
                        </p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Go Back</button>
                        <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
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
