@extends('layouts.app')

@section('page_name')
Dashboard
@endsection

@section('content')
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Posts</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $posts->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Categories</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-list fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"> Users</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Trashed</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $trashed->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-trash fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
