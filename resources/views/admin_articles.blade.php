@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>Manage Articles</h1>

<div class="mb-3">

    <a href="{{ url('/admin/articles/create') }}"
       class="btn btn-success mb-3">

        ➕ Add Article

    </a>

</div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Article Title</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($articles as $article)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $article['title'] }}</td>
            <td>{{ $article['country'] }}</td>
            <td>
                <a href="{{ route('admin.article.edit', $loop->index) }}"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="{{ route('admin.article.delete', $loop->index) }}"
                    class="btn btn-danger btn-sm">
                    Delete
                </a>

            </td>
        </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection