@extends('layouts.app')

@section('page_name')
User profile
@endsection

@section('content')
<div class="col-md-8 offset-2">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
               Edit Profile
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update-profile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea class="form-control" name="about" id="about" cols="5" rows="5">{{ $user->about }}</textarea>
                    @error('about')
                        <div class="text-bold text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if ($user->image != Null)
                    <img src="{{ asset('users/'.$user->image) }}" alt="" width="140px" height="130px" style="border-radius: 5px">
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" >
                    @error('image')
                        <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
