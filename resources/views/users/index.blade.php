@extends('layouts.app')

@section('page_name')
Users
@endsection

@section('content')
<div class="col-10 offset-1 mb-4">
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">User List Table</h6>
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Add User</a>
      </div>
      <div class="table-responsive">
          @if($users->count() > 0)
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                   @foreach ($users as $user)
                    <tr>
                        <td>
                            <img src="{{ ($user->image != Null) ? asset('users/'.$user->image) : asset('assets/admin/img/boy.png') }}" alt="" width="40px" height="40px" style="border-radius: 50%">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            @if (!$user->isAdmin())
                                <form action="{{ route('users.make-admin', $user->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Make Admin</button>
                                </form>
                            @endif
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
