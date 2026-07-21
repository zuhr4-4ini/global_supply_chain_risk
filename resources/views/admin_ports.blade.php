@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>Manage Ports</h1>

    <a href="{{ route('admin.port.create') }}"
        class="btn btn-success mb-4">

            + Add Port
    </a>

    <div class="row">

        @foreach($ports as $port)

            <div class="col-md-4 mb-4">

                <div class="card shadow h-100">

                    <div class="card-body">

                        <h5>{{ $port['name'] }}</h5>

                        <p class="text-muted">
                            {{ $port['country'] }}
                        </p>

                        <a href="{{ route('admin.port.edit', $loop->index) }}"
                            class="btn btn-warning btn-sm">

                                Edit

                        </a>

                        <a href="{{ route('admin.port.delete', $loop->index) }}"
                            class="btn btn-danger btn-sm">

                                Delete

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection