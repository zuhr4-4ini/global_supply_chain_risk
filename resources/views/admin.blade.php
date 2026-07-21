@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>Admin Dashboard</h1>

    <div class="row">

        <div class="col-md-4">

        <a href="{{ route('admin.users') }}"
            class="text-decoration-none text-dark">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h2>👤</h2>

                        <h4>Manage Users</h4>

                    <p>Manage user data.</p>

                </div>

        </a>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h2>🚢</h2>

                    <a href="{{ route('admin.ports') }}"
                        class="text-decoration-none text-dark">

                        <h4>Manage Ports</h4>

                    </a>

                    <p>Manage global port data.</p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow">

            <a href="{{ route('admin.articles') }}"
                class="text-decoration-none text-dark">

                <div class="card-body text-center">

                    <h2>📰</h2>

                    <h4>Manage Articles</h4>

            </a>
                    <p>Manage analysis articles.</p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection