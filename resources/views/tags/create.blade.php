@extends('layouts.app')

@section('page_name')
Tags
@endsection

@section('content')
<div class="col-md-8 offset-2">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            {{ isset($tag)? 'Edit Tag' : 'Create a new tag' }}
        </h6>
        </div>
        <div class="card-body">
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <button class="btn btn-success">
                      {{ isset($tag) ? 'Update' : 'Save' }}
                  </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
