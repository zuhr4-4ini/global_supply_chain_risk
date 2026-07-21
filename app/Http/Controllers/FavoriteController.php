<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    private function getCountryData()
    {
        return [

            'Germany' => [
                'gdp' => 4.5,
                'inflation' => 2.3,
                'risk' => 22,
                'currency' => 'EUR'
            ],

            'Australia' => [
                'gdp' => 1.8,
                'inflation' => 3.1,
                'risk' => 35,
                'currency' => 'AUD'
            ],

            'China' => [
                'gdp' => 18,
                'inflation' => 0.8,
                'risk' => 47,
                'currency' => 'CNY'
            ],

            'Indonesia' => [
                'gdp' => 1.4,
                'inflation' => 2.8,
                'risk' => 28,
                'currency' => 'IDR'
            ],

            'Japan' => [
                'gdp' => 4.2,
                'inflation' => 2.0,
                'risk' => 18,
                'currency' => 'JPY'
            ]

        ];
    }

    public function index()
    {
        $favorites = session('favorites', []);

        $favoriteData = [];

        $countryData = $this->getCountryData();

        foreach ($favorites as $country) {

            $favoriteData[] = [

                'country' => $country,

                'gdp' => $countryData[$country]['gdp'],
                'inflation' => $countryData[$country]['inflation'],
                'risk' => $countryData[$country]['risk'],
                'currency' => $countryData[$country]['currency'],

            ];

        }

        return view('favorite', compact('favoriteData'));
    }

    public function add($country)
    {
        $favorites = session()->get('favorites', []);

        if(!in_array($country, $favorites))
        {
            $favorites[] = $country;
        }

        session()->put('favorites', $favorites);

        return redirect()->back();
    }

    public function remove($country)
    {
        $favorites = session('favorites', []);

        $favorites = array_filter(
            $favorites,
            fn($item) => $item != $country
        );

        session()->put(
            'favorites',
            array_values($favorites)
        );

        return redirect()->back();
    }
}
