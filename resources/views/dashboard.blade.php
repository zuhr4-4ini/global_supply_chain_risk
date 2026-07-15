@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Global Supply Chain Risk Dashboard</h2>
    <p>Welcome to Global Supply Chain Risk Dashboard</p>
    Please select a country to view supply chain risk analysis.
    
    <div class="mb-4">
        <label for="country" class="form-label"></label>

    <form action="/" method="GET">

        <select class="form-select" id="country" name="country" onchange="this.form.submit()">
            <option value="">Select a Country</option>
            <option value="Indonesia" {{ $country=='Indonesia' ? 'selected' : '' }}>Indonesia</option>
            <option value="Germany" {{ $country=='Germany' ? 'selected' : '' }}>Germany</option>
            <option value="Japan" {{ $country=='Japan' ? 'selected' : '' }}>Japan</option>
            <option value="Australia" {{ $country=='Australia' ? 'selected' : '' }}>Australia</option>
        </select>

    </form>

</div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>World Map</h5>
                </div>
            <div class="card-body" style="height:400px;">
                <div id="map" style="height:380px;"></div>
            </div>
        </div>
    </div>
</div>

@if($country)

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5>GDP</h5>
                    <h3>
                        US$ {{ number_format($gdp_trillion, 2) }} T
                    </h3>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5>Inflation</h5>
                    <h3>
                        {{ number_format($inflation, 2) }} %
                    </h3>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5>Population</h5>
                    <h3>
                        {{ number_format($population_million, 2) }} M
                    </h3>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5>Currency</h5>
                    <p>{{ $currency_code }}</p>
                    <p>{{ $currency_name }}</p>
                    <p><strong>1 USD =</strong> {{ number_format($exchange_rate, 2) }} {{ $currency_code }}</p>
                    <p><strong>Region:</strong> {{ $region }}</p>
                    <p><strong>Language:</strong> {{ $language }}</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5>Weather</h5>
                </div>
            <div class="card-body">
                <h3>🌤 {{ $temperature }}°C</h3>
                <p>💨 Wind : {{ $wind_speed }} km/h</p>
                <p>Rain : -</p>
            </div>
        </div>
    </div>

    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Risk Score</h5>
                    <h3>{{ $risk_score }}</h3>
                    <h6>{{ $risk_icon }} {{ $risk_level }}</h6>
                    <hr>
                    <h6>Risk Score Calculation</h6>
                    <p>🌤 Weather Score : {{ $weather_score }}</p>
                    <p>📈 Inflation Score : {{ $inflation_score }}</p>
                    <p>💱 Exchange Score : {{ $exchange_score }}</p>
                    <p>📰 News Score : {{ $news_score }}</p>
                    <hr>
                    <p><strong>Total Score :</strong> {{ $risk_score }}</p>
                    <p><strong>Risk Level :</strong> {{ $risk_level }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Currency Trend (Last 7 Days)
                </div>
                <div class="card-body">
                    <canvas id="exchangeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h3>Global News Intelligent</h3>
        @foreach($news as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $article['title'] }}</h5>
                    <p>{{ $article['description'] }}</p>
                    <a href="{{ $article['url'] }}" target="_blank">
                    Read More
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endif

</div>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

    // Membuat peta dengan tampilan seluruh dunia
    var map = L.map('map').setView([20, 0], 2);

    // Menggunakan OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

@if($country)

    map.setView([{{ $latitude }}, {{ $longitude }}], 5);

    L.marker([{{ $latitude }}, {{ $longitude }}])
        .addTo(map)
        .bindPopup(`
            <b>{{ $country }}</b><br>

            🌧 Rain : {{ $rain }}<br>
            💨 Wind : {{ $wind_speed }} km/h<br>
            ⛈ Storm : {{ $storm }}<br><br>

            Risk Score : {{ $risk_score }}<br>
            {{ $risk_icon }} {{ $risk_level }}
        `)
        .openPopup();

@endif

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('exchangeChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: @json($chartLabels),

        datasets: [{

            label: '1 USD',

            data: @json($chartValues),

            borderColor: '#0d6efd',

            backgroundColor: 'rgba(13,110,253,0.15)',

            fill: true,

            tension: 0.4

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: true

            }

        }

    }

});

</script>

@endsection