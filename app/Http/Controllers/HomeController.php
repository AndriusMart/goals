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
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HTTPHEADER => array(
        //         'X-CSCAPI-KEY: API_KEY'
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;

        // $city = isset($request->city) ? $request->city : 'Vilnius';

        $time_now = Carbon::now();
        $city = isset($request->city) ? $request->city : 'Vilnius';
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
            $city = 'Vilnius';
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
