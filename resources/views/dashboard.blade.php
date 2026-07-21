@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Global Supply Chain Risk Dashboard</h2>
    <p>Welcome to Global Supply Chain Risk Dashboard</p>
    Please select a country to view supply chain risk analysis.
    
    <div class="mb-4">

    <form action="/" method="GET">
        <div class="row gx-4">
           <div class="col-md-6"> 
        
                <label for="country" class="form-label"></label>

        <select class="form-select" id="country" name="country" onchange="this.form.submit()">
            <option value=>Select Country</option>
            <option value="Indonesia" {{ $country=='Indonesia' ? 'selected' : '' }}>Indonesia</option>
            <option value="Germany" {{ $country=='Germany' ? 'selected' : '' }}>Germany</option>
            <option value="Japan" {{ $country=='Japan' ? 'selected' : '' }}>Japan</option>
            <option value="Australia" {{ $country=='Australia' ? 'selected' : '' }}>Australia</option>
        </select>
    </div>

            <div class="col-md-6">

                <label for="port" class="form-label"></label>

            <select
                id="portSelect"
                class="form-select"
                {{ empty($ports) ? 'disabled' : '' }}
            >
                @if(empty($ports))
                    <option>Please select a country first</option>
                @else
                @endif

                <option>Select Port</option>

                @foreach($ports as $port)
                    <option
                        value="{{ $port['lat'] }},{{ $port['lng'] }}">
                        {{ $port['name'] }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>

    </form>

</div>

    <div class="row">
        <div class="col-7 mb-4">
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

<div class="mb-3">

    <a href="{{ route('favorite.add', $country) }}"
        class="btn btn-warning">
            ⭐ Add {{ $country }} To Favorite
    </a>

</div>

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
        <div class="col-md-4">
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

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Currency Trend</h5>
            </div>
            <div class="card-body" style="height:250px;">
                <canvas id="exchangeChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>GDP Trend</h5>
            </div>
                <div class="card-body" style="height:250px;">
                    <canvas id="gdpChart"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Inflation Trend</h5>
            </div>
            <div class="card-body" style="height:250px;">
                <canvas id="inflationChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Risk Trend</h5>
            </div>
            <div class="card-body" style="height:250px;">
                <canvas id="riskChart"></canvas>
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

        var portIcon = L.divIcon({
            html: '<div style="font-size:30px;">🚢</div>',
            className: 'port-icon',
            iconSize: [30,30],
            iconAnchor: [15,15]
        });

@foreach($ports ?? [] as $port)

    var marker = L.marker(
        [{{ $port['lat'] }}, {{ $port['lng'] }}],
        { icon: portIcon }
    )
    .addTo(map)
    .bindPopup(`
        <b>🚢 {{ $port['name'] }}</b><br>
        Country : {{ $country }}
    `);

    marker.portName = "{{ $port['name'] }}";

@endforeach

@endif

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

//Currency Chart

const ctx = document.getElementById('exchangeChart');

new Chart(ctx, {

    type: 'line',

    data: {
        labels: @json($chartLabels ?? []),
        datasets: [{

            label: '1 USD',
            data: @json($chartValues ?? []),

            borderColor: '#0d6efd',

            backgroundColor: 'rgba(13,110,253,0.15)',

            fill: true,

            tension: 0.4

        }]

    },

    options: {

        responsive: true,
        maintainAspectRatio: false,
    }
});

//GDP Chart

console.log(@json($gdpLabels ?? []));
console.log(@json($gdpValues ?? []));

const gdpCtx = document.getElementById('gdpChart');

new Chart(gdpCtx,{

    type:'line',
    
    data:{

        labels: @json($gdpLabels ?? []),

        datasets:[{
            label:'GDP (Trillion USD)',

            data: @json($gdpValues ?? []),

            borderColor:'#198754',
            backgroundColor:'rgba(98, 204, 154, 0.15)',
            fill:true,
            tension:0.4
        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false
    }
});

//Inflation Chart

const inflationCtx = document.getElementById('inflationChart');

new Chart(inflationCtx,{
    type:'line',
    data:{
        labels:@json($inflationLabels ?? []),

        datasets:[{
            label:'Inflation (%)',

            data:@json($inflationValues ?? []),

            borderColor:'#dc3545',
            backgroundColor:'rgba(220,53,69,0.15)',
            fill:true,
            tension:0.4
        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false
    }
});

//Risk Trend

const riskCtx = document.getElementById('riskChart');

new Chart(riskCtx, {

    type: 'line',

    data: {

        labels: @json($riskLabels ?? []),

        datasets: [{

            label: 'Risk Score',

            data: @json($riskValues ?? []),

            borderColor: '#fd7e14',

            backgroundColor: 'rgba(253,126,20,0.15)',

            fill: true,

            tension: 0.4

        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false

    }

});

//Port Marker

document.getElementById("portSelect").addEventListener("change", function () {

    if(this.value == "") return;

    let coord = this.value.split(",");
    let lat = parseFloat(coord[0]);
    let lng = parseFloat(coord[1]);

    map.setView([lat, lng], 10);
    map.eachLayer(function(layer){
        if(layer instanceof L.Marker){
            let markerLat = layer.getLatLng().lat;
            let markerLng = layer.getLatLng().lng;

            if(markerLat == lat && markerLng == lng){

                layer.openPopup();
            }
        }
    });
});

</script>

@endsection