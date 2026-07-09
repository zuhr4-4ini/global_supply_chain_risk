<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
        {
            $country = $request->get('country');

            if (!$country) {
                $country = 'Indonesia';
            }

            $coordinates = [
                'Indonesia' => ['lat' => -6.221441, 'lon' => 106.78094],
                'Japan' => ['lat' => 35.6762, 'lon' => 139.6503],
                'Germany' => ['lat' => 52.5200, 'lon' => 13.4050],
                'Australia' => ['lat' => -35.2809, 'lon' => 149.1300],
            ];

            $countryInfo = [
                'Indonesia' => [
                    'currency_code' =>'IDR',
                    'currency_name' => 'Indonesia Rupiah',
                    'region' => 'Asia',
                    'language' => 'Indonesia',
                ],
                'Japan' => [
                    'currency_code' => 'JPY',
                    'currency_name' => 'Japanese Yen',
                    'region' => 'Asia',
                    'language' => 'Japanes',   
                ],
                'Germany' => [
                    'currency_code' => 'EUR',
                    'currency_name' => 'Euro',
                    'region' => 'Europe',
                    'language' => 'German',
                ],
                'Australia' => [
                    'currency_code' => 'AUD',
                    'currency_name' => 'Australian Dollar',
                    'region' => 'Oceania',
                    'language' => 'English',
                ],
            ];

            $latitude = $coordinates[$country]['lat'];
            $longitude = $coordinates[$country]['lon'];

            $countryData = $countryInfo[$country];

                $currency_code = $countryData['currency_code'];
                $currency_name = $countryData['currency_name'];
                $region = $countryData['region'];
                $language = $countryData['language'];

            $response = Http::get("https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&current=temperature_2m,wind_speed_10m");
    
            $weather = $response->json();

            $exchangeResponse = Http::get('https://open.er-api.com/v6/latest/USD');

            $exchange = $exchangeResponse->json();
            $exchange_rate = $exchange['rates'][$currency_code];

            $temperature = $weather['current']['temperature_2m'];
            $wind_speed = $weather['current']['wind_speed_10m'];

            return view('dashboard', [
                'temperature' => $temperature,
                'wind_speed' => $wind_speed,
                'currency_code' => $currency_code,
                'currency_name' => $currency_name,
                'region' => $region,
                'language' => $language,
                'exchange_rate' => $exchange_rate,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'country' => $country,
            ]);
        }
}
