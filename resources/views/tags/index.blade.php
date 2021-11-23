@extends('layouts.app')

@section('page_name')
Tags create
@endsection

@section('content')
<div class="col-10 offset-1 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tag List Table</h6>
        @if(Auth()->user()->role == 'admin')
        <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Add Tag</a>
        @endif
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <th>Name</th>
                <th>No of Posts</th>
                <th>Action</th>
            </thead>
            @if($tags->count() > 0)
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->posts->count() }}</td>
                    <td>
                        @if(Auth()->user()->role == 'admin')
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})"><i class="fas fa-trash"></i></button>
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
                <form action="" method="POST" id="deleteTag">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <p class="text-center text-bold">
                            Are you sure to delete {{ $tag->name }}?
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
            var form =document.getElementById('deleteTag')
            form.action = '/tags/'+$id
            //console.log(form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
