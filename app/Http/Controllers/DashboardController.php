<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
        {
            $country = $request->get('country');

            if (!$country) {
                return view('dashboard', ['country' => null,]);
            }

            $countryCodes = [
                'Indonesia' => 'IDN',
                'Japan' => 'JPN',
                'Germany' => 'DEU',
                'Australia' => 'AUS',
            ];

            $countryCode = $countryCodes[$country];

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
                    'language' => 'Japanese',   
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

            //Open-Meteo => weather

            $weatherResponse = Http::timeout(30)->get("https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&current=temperature_2m,wind_speed_10m,weather_code");
            $weather = $weatherResponse->json();

            $temperature = $weather['current']['temperature_2m'];
            $wind_speed = $weather['current']['wind_speed_10m'];
            $weather_code = $weather['current']['weather_code'];

            // Rain
            if(in_array($weather_code,[51,53,55,61,63,65,80,81,82])){
                $rain = "Rain";
            }
            else{
            $rain = "None";
            }

            // Strong Wind
            if ($wind_speed >= 15) {
                $strong_wind = "Yes";
            } else {
                $strong_wind = "No";
            }

            // Storm
            if(in_array($weather_code,[95,96,99])){
                $storm = "Storm";
            }
            else{
            $storm = "None";
            }

            // Temperature Score

            if ($temperature < 10) {
                $temp_score = 20;
            } elseif ($temperature < 25) {
                $temp_score = 10;
            } elseif ($temperature < 35) {
                $temp_score = 15;
            } else {
                 $temp_score = 30;
            }

            // Wind Score

            if ($wind_speed < 15) {
                $wind_score = 0;
            } elseif ($wind_speed < 30) {
                $wind_score = 10;
            } elseif ($wind_speed < 50) {
                 $wind_score = 20;
            } else {
                $wind_score = 40;
            }

            //GDP

            $gdpRespone = Http::get("https://api.worldbank.org/v2/country/{$countryCode}/indicator/NY.GDP.MKTP.CD?format=json");
            $gdp = $gdpRespone->json()[1][0]['value'];

            $gdp_trillion = $gdp / 1000000000000;

            //Inflation

            $inflationResponse = Http::get("https://api.worldbank.org/v2/country/{$countryCode}/indicator/FP.CPI.TOTL.ZG?format=json");
            $inflation = $inflationResponse->json()[1][0]['value'];

            $inflation_percent = $inflation;

            //Inflation Score

            if ($inflation <= 5) {
                $inflation_score = 5;
            }
            elseif ($inflation <= 10) {
                $inflation_score = 10;
            }
            elseif ($inflation <= 15) {
                $inflation_score = 20;
            }
            else {
                $inflation_score = 30;
            }

            //Population

            $populationResponse = Http::get("https://api.worldbank.org/v2/country/{$countryCode}/indicator/SP.POP.TOTL?format=json");
            $population = $populationResponse->json()[1][0]['value'];

            $population_million = $population / 1000000;

            //ExchangeRate

            $exchangeResponse = Http::get('https://open.er-api.com/v6/latest/USD');
            $exchange = $exchangeResponse->json();

            $exchange_rate = $exchange['rates'][$currency_code];

            $endDate = Carbon::today()->format('Y-m-d');
            $startDate = Carbon::today()->subDays(6)->format('Y-m-d');

            $history = Http::get("https://api.frankfurter.app/$startDate..$endDate?from=USD&to=$currency_code")->json();

            $chartLabels = [];
            $chartValues = [];

            if (isset($history['rates'])) {

                foreach ($history['rates'] as $date => $rate) {

                     $chartLabels[] = $date;
                    $chartValues[] = $rate[$currency_code];

                }

            }

            // Exchange Rate Score

            if ($exchange_rate <= 2) {
                $exchange_score = 5;
            }
            elseif ($exchange_rate <= 50) {
                $exchange_score = 10;
            }
            elseif ($exchange_rate <= 500) {
                $exchange_score = 20;
            }
            else {
                $exchange_score = 30;
            }

            //News Intelligent

            $newsResponse = Http::get(
                'https://gnews.io/api/v4/search',
                [
                    'q' => $country . ' logistics OR trade OR shipping OR economy',
                    'lang' => 'en',
                    'max' => 5,
                    'apikey' => config('services.gnews.key'),
                ]
            );

            $news = $newsResponse->json()['articles'];

            // Positive Keywords

            $positiveWords = [
                'agreement',
                'cooperation',
                'investment',
                'growth',
                'recovery',

                'expansion',
                'improvement',
                'development',
                'stable',
                'efficiency',

                'innovation',
                'increase',
                'partnership',
                'export',
                'success',
            ];

            // Negative Keywords

            $negativeWords = [
                'war',
                'conflict',
                'sanction',
                'crisis',
                'recession',

                'disaster',
                'disruption',
                'strike',
                'shortage',
                'inflation',

                'delay',
                'congestion',
                'tariff',
                'decline',
                'protest',
            ];

            //News Sentiment

            $totalSentiment = 0;

            foreach ($news as $article) {
                $text = strtolower($article['title'] .''. $article['description']);

                foreach ($positiveWords as $word) {
                    if (str_contains($text, $word)) {
                        $totalSentiment++;
                    }
                }

                foreach ($negativeWords as $word) {
                    if (str_contains($text, $word)) {
                        $totalSentiment--;
                    }
                }
            }

            // News Score

            if ($totalSentiment <= -10) {
                $news_score = 0;
            }
            elseif ($totalSentiment <= 0) {
                $news_score = 5;
            }
            elseif ($totalSentiment <= 10) {
                $news_score = 10;
            }
            elseif ($totalSentiment <= 20) {
                $news_score = 15;
            }
            else {
                $news_score = 20;
            }

            // Risk Scoring Engine 

            $weather_score = $temp_score + $wind_score;
            $risk_score = $weather_score + $inflation_score + $exchange_score + $news_score;

            //Risk Level

            if ($risk_score <= 30) {
                $risk_level = "Low Risk";
            } 
            elseif ($risk_score <= 60) {
                $risk_level = "Medium Risk";
            } else {
                $risk_level = "High Risk";
            }

            //Risk Icon

            if($risk_level == "Low Risk"){
                $risk_icon = "🟢";
            }
            elseif($risk_level == "Medium Risk"){
                $risk_icon = "🟠";
            }
            else{
                $risk_icon = "🔴";
            }
            
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
                'gdp_trillion' => $gdp_trillion,
                'population' => $population,
                'population_million' => $population_million,
                'inflation' => $inflation,
                'weather_score' => $weather_score,
                'inflation_score' => $inflation_score,
                'exchange_score' => $exchange_score,
                'risk_score' => $risk_score,
                'risk_level' => $risk_level,
                'news' => $news,
                'news_score' => $news_score,
                'totalSentiment' => $totalSentiment,
                'risk_icon' => $risk_icon,
                'rain' => $rain,
                'strong_wind' => $strong_wind,
                'storm' => $storm,
                'rain' => $rain,
                'storm' => $storm,
                'chartLabels' => $chartLabels,
                'chartValues' => $chartValues,
            ]);
        }
}
