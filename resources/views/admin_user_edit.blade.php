@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Edit User</h1>

    <form action="/admin/users/update/{{ $id }}"
          method="POST">

        @csrf

        <div class="mb-3">

            <label>Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $user['name'] }}">

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ $user['email'] }}">

        </div>

        <div class="mb-3">

            <label>Role</label>

            <select name="role"
                    class="form-control">

                <option value="User"
                    {{ $user['role']=='User' ? 'selected' : '' }}>
                    User
                </option>

                <option value="Administrator"
                    {{ $user['role']=='Administrator' ? 'selected' : '' }}>
                    Administrator
                </option>

            </select>

        </div>

        <button class="btn btn-success">

            Update 

        </button>

    </form>

</div>

@endsection