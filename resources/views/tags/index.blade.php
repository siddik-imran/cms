@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <b>Tags</b>
            <a href="{{ route('tags.create') }}" class="btn btn-success float-right">Add Tag</a>
        </div>
        <div class="card-body">
            @if ($tags->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>No of Posts</th>
                    <th>Action</th>
                </thead>
                <tbody>
                   @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts->count() }}</td>
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
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
            var form =document.getElementById('deleteTag')
            form.action = '/tags/'+$id
            //console.log(form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
