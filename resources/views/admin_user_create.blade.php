@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Add New User</h1>

    <form action="{{ route('admin.users.store') }}"
        method="POST">

        @csrf

        <div class="mb-3">

            <label>Name</label>

            <input type="text"
                    name="name"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Role</label>

                <select name="role"
                        class="form-control">

                    <option value= disabled>choose👇</option>

                    <option value="User">User</option>

                    <option value="Administrator">Administrator</option>

                </select>

        </div>

        <button class="btn btn-success">

            Save

        </button>

    </form>

</div>

@endsection