@extends('layouts.app')

@section('content')
    <div class="card card-deafult">
        <div class="card-header">
           {{ isset($post) ? 'Edit Post' : 'Create Post' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (isset($post))
                @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ isset($post) ? $post->title : '' }}">
                    @error('title')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="3" rows="3" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
                    @error('description')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                    @error('content')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" placeholder="Pick your Date & Time" value="{{ isset($post) ? $post->published_at : '' }}">
                    @error('published_at')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                @if (isset($post))
                <div class="form-group">
                    <img src="{{ asset('uploads/'.$post->image) }}" alt="" style="width: 400px; height:300px; border-radius:5px">
                </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" >
                    @error('image')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <select name="category" id="category" class="form-control">
                       @foreach ($categories as $category )
                            <option value="{{ $category->id }}"
                                @if(isset($post))
                                    @if($category->id == $post->category_id) selected
                                    @endif
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                       @endforeach
                    </select>
                    @error('category')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-sm btn-success">
                       {{ isset($post) ? 'Update' : 'Create' }}
                   </button>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
        })
    </script>
@endsection
