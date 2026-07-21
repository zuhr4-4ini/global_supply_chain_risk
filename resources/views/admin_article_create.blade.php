@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Add New Article</h1>

    <form action="{{ route('admin.articles.store') }}"
            method="POST">
        @csrf

        <div class="mb-3">

            <label>Title</label>

            <input type="text"
                    name="title"
                    class="form-control">

        </div>

        <div class="mb-3">

            <label>Country</label>

            <input type="text"
                   name="country"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Content</label>

            <textarea name="content"
                    class="form-control"
                    rows="6"></textarea>

        </div>

        <button class="btn btn-success">

            Save Article

        </button>

    </form>

</div>

@endsection