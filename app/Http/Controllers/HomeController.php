<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Cache;
use Exception;

class HomeController extends Controller
{
    public function homeList(Request $request)
    {
        $city = $request->validate(['city' => 'string|min:3']);
        if (!$city) {
            $city = $request->validate(['search_city' => 'string|min:3']);
        }
        if (!$city) {
            $city = $this->getCityByIp($request->ip());
        } 
        try {
            $weather = $this->getWeatherData($city);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        $weather = $this->getWeatherData($city);
        if (!$weather) {
            $city = $this->getCityByIp($request->ip());
            $weather = $this->getWeatherData($city);
        } 
        
        return view('home.index', [
            'goals' => Goal::orderBy('title', 'asc')->get(),
            'time_now' => Carbon::now(),
            'temp' => $weather['main']['temp'],
            'city' => $weather['name'],
            'weather' => $weather['weather'][0]['description']
        ]);
    }

private function getCityByIp($ip)
    {
        if (Location::get($ip)) {
            return Location::get($ip)->cityName;
        }
        return 'Kaunas';
    }

private function getWeatherData($city)
    {
        if(is_array($city)){
          $city = implode(" ",$city);  
        }
        $weather = Cache::remember("weather.$city", 60, function () use ($city) {
            $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=" . env('OPEN_WEATHER_MAP_KEY') . "&units=metric";
            // dd($url);
            return Http::get($url)->json();
        });
        if (isset($weather['main']) && isset($weather)) {
            return $weather;
        }
        return null;
    }
    
}
