@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>Manage Users</h1>

    <a href="{{ route('admin.users.create') }}"
        class="btn btn-success mb-3">
            Add User
    </a>

    <table class="table table-bordered w-50 mx-auto">

        <thead>

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>

        </thead>

        <tbody>

            @foreach($users as $index => $user)

            <tr>

                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['role'] }}</td>

                <td>
                    <a href="/admin/users/edit/{{ $index }}"
                        class="btn btn-warning btn-sm">
                            Edit
                    </a>

                    <form action="/admin/users/delete/{{ $index }}"
                        method="POST"
                        class="d-inline">

                        @csrf

                        <button type="submit"
                                class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </td>
                
            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection