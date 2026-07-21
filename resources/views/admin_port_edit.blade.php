@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Edit Port</h1>

    <form action="{{ route('admin.port.update', $id) }}"
        method="POST">

        @csrf

        <div class="mb-3">

            <label>Port Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $port['name'] }}">

        </div>

        <div class="mb-3">

            <label>Country</label>

            <input type="text"
                   name="country"
                   class="form-control"
                   value="{{ $port['country'] }}">

        </div>

        <button class="btn btn-success">

            Update Port

        </button>

    </form>

</div>

@endsection