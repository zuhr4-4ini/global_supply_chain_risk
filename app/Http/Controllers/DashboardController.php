<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
        {
            $response = Http::get('https://api.open-meteo.com/v1/forecast?latitude=-6.2&longitude=106.8&current=temperature_2m,wind_speed_10m');

            $weather = $response->json();

            $temperature = $weather['current']['temperature_2m'];
            $wind_speed = $weather['current']['wind_speed_10m'];

            return view('dashboard', [
                'temperature' => $temperature,
                'wind_speed' => $wind_speed
            ]);
        }
}
