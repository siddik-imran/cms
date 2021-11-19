@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <b>Posts</b>
            <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Add Post</a>
        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Action</th>
                </thead>
                <tbody>
                   @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset('uploads/'.$post->image)}}" alt="" width="80px" height="50px" style="border-radius: 5px">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $post->category->id) }}">
                                {{ $post->category->name }}
                            </a>
                        </td>
                        <td class="d-flex">
                            @if ($post->trashed())
                               <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success mr-2">Restore</button>
                               </form>
                            @else
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm text-white btn-info mr-2">Edit</a>
                            @endif
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-danger ">
                                    {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
            @else
             <h3 class="text-center text-bold"> No record found</h3>
            @endif
        </div>
    </div>
@endsection
