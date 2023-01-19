<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{



    public function homeList(Request $request)
    {

        $ip = $request->ip();
        if (Location::get($ip)) {
            $position = Location::get($ip)->cityName;
        } else {
            $position = 'Kaunas';
        }

        $time_now = Carbon::now();
        $city = isset($request->city) ? $request->city : $position;
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=4b8ae4fdc2fa26b5e710d1bf79129fde&units=metric';
        $json = Http::get($url);
        $weather = $json->json();
        if (isset($weather['main']) && isset($weather)) {
            return view('home.index', [
                'goals' => Goal::orderBy('title', 'asc')->get(),
                'time_now' => $time_now,
                'temp' => $weather['main']['temp'],
                'city' => $weather['name'],
                'weather' => $weather['weather'][0]['description']

            ]);
        } else {
            $ip = $request->ip();
            if (Location::get($ip)) {
                $city = Location::get($ip)->cityName;
            } else {
                $city = 'Kaunas';
            }
            $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=4b8ae4fdc2fa26b5e710d1bf79129fde&units=metric';
            $json = Http::get($url);
            $weather = $json->json();
            return view('home.index', [
                'goals' => Goal::orderBy('title', 'asc')->get(),
                'time_now' => $time_now,
                'temp' => $weather['main']['temp'],
                'city' => $weather['name'],
                'weather' => $weather['weather'][0]['description']
            ]);
        }
    }
    public function searchCity(Request $request)
    {
        return redirect()->route('home', [
            'city' => $request->city
        ]);
    }
    
}
