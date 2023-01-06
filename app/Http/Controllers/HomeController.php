<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{



    public function homeList(Request $request)
    {
        $city = $this->searchCity($request);
        $city = isset($request->city) ? $request->city : 'Vilnius';
        $json = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=4b8ae4fdc2fa26b5e710d1bf79129fde');
        $time_now = Carbon::now();
        $weather = $json->json();
        // dump($weather['weather'][0]['description']);

        return view('home.index', [
            'goals' => Goal::orderBy('title', 'asc')->get(),
            'time_now' => $time_now,
            'temp' => $weather['main']['temp'],
            'city' => $weather['name'],
            'weather' => $weather['weather'][0]['description']

        ]);
    }
    public function searchCity(Request $request)
    {
        $city = $request->city;
        return redirect()->route('home', [
            'city' => $city
        ]);
    }
}
