<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Supply Chain Risk Intelligence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet/dist/leaflet.css"
    />
</head>

<body>

    @include('part.navbar')

    @yield('content')

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>

        var map = L.map('map').setView(
            [{{ $latitude }}, {{ $longitude }}],
            5
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        L.marker([{{ $latitude }}, {{ $longitude }}])
            .addTo(map)
            .bindPopup("{{ $country }}")
            .openPopup();
            
    </script>

</body>

</html>