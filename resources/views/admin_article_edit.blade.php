@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Edit Article</h1>

    <form action="{{ route('admin.article.update', $id) }}"
        method="POST">

    @csrf

        <div class="mb-3">

            <label>Title</label>

            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ $article['title'] }}">

        </div>

        <div class="mb-3">

            <label>Country</label>

            <input type="text"
                   name="country"
                   class="form-control"
                   value="{{ $article['country'] }}">

        </div>

        <button class="btn btn-success">

            Update Article

        </button>

    </form>

</div>

@endsection