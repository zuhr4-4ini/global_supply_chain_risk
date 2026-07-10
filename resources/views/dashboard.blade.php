@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Global Supply Chain Risk Dashboard</h2>
    <p>Welcome to Global Supply Chain Risk Dashboard</p>

    <div class="mb-4">
        <label for="country" class="form-label">Select Country</label>

    <form action="/" method="GET">

        <select class="form-select" id="country" name="country" onchange="this.form.submit()">
            <option selected>Select a Country</option>
            <option>Indonesia</option>
            <option>Germany</option>
            <option>China</option>
            <option>Australia</option>
            <option>USA</option>
            <option>Korea</option>
            <option>Canada</option>
            <option>Japan</option>
            <option>Italy</option>
            <option>France</option>
            <option>Singapore</option>
            <option>Saudi Arabia</option>
            <option>New Zealand</option>
            <option>Switzerland</option>
        </select>

    </form>

</div>

    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>GDP</h5>
                    <h3>
                        US$ {{ number_format($gdp_trillion, 2) }} T
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Inflation</h5>
                    <h3>-</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Currency</h5>
                    <h4>{{ $currency_code }}</h4>
                    <p>{{ $currency_name }}</p>
                    <p><strong>1 USD =</strong> {{ number_format($exchange_rate, 2) }} {{ $currency_code }}</p>
                    <p><strong>Region:</strong> {{ $region }}</p>
                    <p><strong>Language:</strong> {{ $language }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Risk Score</h5>
                    <h3>-</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Weather
            </div>

            <div class="card-body">
                <h3>🌤 {{ $temperature }}°C</h3>
                <p>💨 Wind : {{ $wind_speed }} km/h</p>
                <p>Rain : -</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                World Map
            </div>

            <div class="card-body" style="height:300px;">
                <div id="map" style="height:300px;"></div>
            </div>
        </div>
    </div>

</div>

</div>

@endsection