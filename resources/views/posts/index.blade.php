@extends('layouts.app')

@section('page_name')
Posts
@endsection

@section('content')
<div class="col-10 offset-1 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Post List Table</h6>
        
        <a href="{{ route('posts.create')}}" class="btn btn-primary btn-sm float-end"> <i class="fas fa-plus-circle"></i> Add Post</a>
      </div>
      <div class="table-responsive">
        @if($posts->count() > 0)
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
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
                                    <button type="submit" class="btn btn-sm btn-success mr-2"><i class="fas fa-trash-restore"></i></button>
                               </form>
                            @else
                                @if(Auth::user()->id == $post->user_id)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm text-white btn-info mr-2"><i class="fas fa-edit"></i></a>
                                @elseif(Auth::user()->role == 'admin')
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm text-white btn-info mr-2"><i class="fas fa-edit"></i></a>
                                @endif
                            @endif
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if(Auth()->user()->role == 'admin')
                                <button type="submit"  class="btn btn-sm btn-danger ">
                                    @if($post->trashed())
                                    <i class="fas fa-trash"></i>
                                    @else
                                    <i class="far fa-trash-alt"></i>
                                    @endif
                                </button>
                                @endif
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
        <div class="card-footer"></div>
    </div>
</div>
@endsection
