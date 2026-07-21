@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>Favorite Monitoring List</h1>

    <p>Countries being monitored.</p>

@if(count($favoriteData) > 0)

    @foreach($favoriteData as $country)

        <div class="card mt-3">
            <div class="card-body">

                <h4>🌍 {{ $country['country'] }}</h4>

                <p><strong>GDP :</strong> {{ $country['gdp'] }} T</p>

                <p><strong>Inflation :</strong> {{ $country['inflation'] }} %</p>

                <p><strong>Risk Score :</strong> {{ $country['risk'] }}</p>

                <p><strong>Currency :</strong> {{ $country['currency'] }}</p>

                <a href="{{ route('favorite.remove', $country['country']) }}"
                class="btn btn-danger btn-sm mt-2">
                    ❌ Remove
                </a>

            </div>
        </div>

    @endforeach

@else

    <div class="alert alert-warning">
        No favorite country yet.
    </div>

    <div class="row mt-4">

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">

                <h4>🇩🇪 Germany</h4>

                <p>Status Risk : Low</p>

                <button class="btn btn-danger btn-sm">
                    Remove
                </button>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">

                <h4>🇨🇳 China</h4>

                <p>Status Risk : Medium</p>

                <button class="btn btn-danger btn-sm">
                    Remove
                </button>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">

                <h4>🇦🇺 Australia</h4>

                <p>Status Risk : Low</p>

                <button class="btn btn-danger btn-sm">
                    Remove
                </button>

            </div>
        </div>
    </div>

</div>

</div>

@endif

@endsection