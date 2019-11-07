<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $weather = $this->getWeather();
        $users = null;
        if (Gate::allows("admin")) {
            $users = User::all();
        }
        return view('home', compact('users', 'weather'));
    }

    public function getWeather()
    {
        $client = new Client();
        $resuilt = $client->get('https://api.openweathermap.org/data/2.5/weather?q=Hanoi&appid=055b98c98827766723f092cf46e685b6');
        $dataWeather = $resuilt->getBody();
        $dataJson = $dataWeather->getContents();
        $weather = json_decode($dataJson);

        return $weather;

    }
}
