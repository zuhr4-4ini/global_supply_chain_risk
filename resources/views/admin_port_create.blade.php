@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Add New Port</h1>

    <form action="{{ route('admin.port.store') }}"
            method="POST">

        @csrf

        <div class="mb-3">

            <label>Port Name</label>

            <input type="text"
                   name="name"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Country</label>

            <input type="text"
                    name="country"
                   class="form-control">

        </div>

        <button class="btn btn-success">

            Save Port

        </button>

    </form>

</div>

@endsection