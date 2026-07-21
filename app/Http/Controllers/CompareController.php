<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $country1 = $request->country1;
        $country2 = $request->country2;

        $country1_gdp = 4.5;
        $country2_gdp = 1.8;

        $country1_inflation = 2.3;
        $country2_inflation = 3.1;

        $country1_risk = 22;
        $country2_risk = 35;

        $country1_temp = 18;
        $country2_temp = 25;

        $country1_currency = "EUR";
        $country2_currency = "AUD";

        $data = [

            'Germany' => [
                'gdp' => 4.5,
                'inflation' => 2.3,
                'risk' => 22,
                'temperature' => 18,
                'currency' => 'EUR'
            ],

            'Australia' => [
                'gdp' => 1.8,
                'inflation' => 3.1,
                'risk' => 35,
                'temperature' => 25,
                'currency' => 'AUD'
            ],

            'Indonesia' => [
                'gdp' => 1.4,
                'inflation' => 2.8,
                'risk' => 28,
                'temperature' => 31,
                'currency' => 'IDR'
            ],

            'Japan' => [
                'gdp' => 4.2,
                'inflation' => 2.1,
                'risk' => 20,
                'temperature' => 22,
                'currency' => 'JPY'
            ],

            'China' => [
                'gdp' => 18.0,
                'inflation' => 0.8,
                'risk' => 47,
                'temperature' => 29,
                'currency' => 'CNY'
            ],

        ];

        $country1Data = $data[$country1] ?? null;
        $country2Data = $data[$country2] ?? null;

        return view('compare', compact(
            'country1',
            'country2',
            'country1Data',
            'country2Data',
            'country1_gdp',
            'country2_gdp',
            'country1_inflation',
            'country2_inflation',
            'country1_risk',
            'country2_risk',
            'country1_temp',
            'country2_temp',
            'country1_currency',
            'country2_currency',
        ));
    }
}
