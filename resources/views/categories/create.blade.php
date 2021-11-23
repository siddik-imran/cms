@extends('layouts.app')

@section('page_name')
Caregory create
@endsection

@section('content')
<div class="col-md-8 offset-2">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            {{ isset($category)? 'Edit Category' : 'Create a new category' }}
        </h6>
        </div>
        <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" >
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{ isset($category) ? $category->name : '' }}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($category) ? 'Update' : 'Create' }}
            </button>
        </form>
        </div>
    </div>
</div>
@endsection
