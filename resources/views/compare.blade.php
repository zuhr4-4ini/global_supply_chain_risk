@extends('layouts.app')

<style>select:invalid{color:#6c757d;}</style>

@section('content')

<div class="container mt-4">

    <h1>Country Comparison Engine</h1>

    <p>Compare two countries.</p>

<form action="{{ route('compare') }}" method="GET">

    <div class="row mt-4">

        <div class="col-md-5">
            <label>Country 1</label>
            <select name="country1" class="form-select" required>

                <option value="" disabled>-- Select Country --</option>

                <option value="Germany"
                {{ request('country1') == 'Germany' ? 'selected' : '' }}>
                    Germany
                </option>

                <option value="Australia"
                {{ request('country1') == 'Australia' ? 'selected' : '' }}>
                    Australia
                </option>

                <option value="China"
                {{ request('country1') == 'China' ? 'selected' : '' }}>
                    China
                </option>

                <option value="Indonesia"
                {{ request('country1') == 'Indonesia' ? 'selected' : '' }}>
                    Indonesia
                </option>

                <option value="Japan"
                {{ request('country1') == 'Japan' ? 'selected' : '' }}>
                    Japan
                </option>

            </select>
        </div>

        <div class="col-md-5">
            <label>Country 2</label>
            <select name="country2" class="form-select" required>

                <option value="" disabled>
                    -- Select Country --
                </option>

                <option value="Germany"
                {{ request('country2') == 'Germany' ? 'selected' : '' }}>
                    Germany
                </option>
                
                <option value="Australia"
                {{ request('country2') == 'Australia' ? 'selected' : '' }}>
                    Australia
                </option>

                <option value="China"
                {{ request('country2') == 'China' ? 'selected' : '' }}>
                    China
                </option>

                <option value="Indonesia"
                {{ request('country2') == 'Indonesia' ? 'selected' : '' }}>
                    Indonesia
                </option>

                <option value="Japan"
                {{ request('country2') == 'Japan' ? 'selected' : '' }}>
                    Japan
                </option>

            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">
                Compare
            </button>
        </div>

    </div>

</form>

@if($country1 && $country2)

<div class="row mt-4">

    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>{{ $country1 }}</h4>
            </div>

            <div class="card-body">
                <p><strong>GDP :</strong> {{ $country1Data['gdp'] }} T</p>
                <p><strong>Inflation :</strong> {{ $country1Data['inflation'] }} %</p>
                <p><strong>Risk Score :</strong> {{ $country1Data['risk'] }}</p>
                <p><strong>Temperature :</strong> {{ $country1Data['temperature'] }}°C</p>
                <p><strong>Currency :</strong> {{ $country1Data['currency'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>{{ $country2 }}</h4>
            </div>

            <div class="card-body">
                <p><strong>GDP :</strong> {{ $country2Data['gdp'] }} T</p>
                <p><strong>Inflation :</strong> {{ $country2Data['inflation'] }} %</p>
                <p><strong>Risk Score :</strong> {{ $country2Data['risk'] }}</p>
                <p><strong>Temperature :</strong> {{ $country2Data['temperature'] }} °C</p>
                <p><strong>Currency :</strong> {{ $country2Data['currency'] }}</p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5>Comparison Chart</h5>
        </div>

        <div class="card-body" style="height:300px;">
            <canvas id="compareChart"></canvas>
        </div>
    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const compareCtx =
document.getElementById('compareChart');

new Chart(compareCtx,{

    type:'bar',

    data:{

        labels:[
            'GDP',
            'Inflation',
            'Risk Score'
        ],

        datasets:[

            {
                label:'{{ $country1 }}',

                data:[
                    {{ $country1Data['gdp'] }},
                    {{ $country1Data['inflation'] }},
                    {{ $country1Data['risk'] }}
                ]
            },

            {
                label:'{{ $country2 }}',

                data:[
                    {{ $country2Data['gdp'] ?? 'No Data' }},
                    {{ $country2Data['inflation'] }},
                    {{ $country2Data['risk'] }}
                ]
            }

        ]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false
    }

});

</script>

@endif

@endsection