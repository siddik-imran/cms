@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <b>Users</b>
            {{-- <a href="{{ route('users.create') }}" class="btn btn-success float-right">Add User</a> --}}
        </div>
        <div class="card-body">
            @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                   @foreach ($users as $user)
                    <tr>
                        <td>
                            <img src="{{ Gravatar::get($user->email)}}" alt="" width="40px" height="40px" style="border-radius: 50%">
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
    </div>
@endsection
