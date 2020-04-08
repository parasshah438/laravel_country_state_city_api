<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $key = config('services.api.key');
        $country = Http::get('https://geo-battuta.net/api/country/all/?key='.$key.'')->json();

        return view('home',compact('country'));
    }

    public function state()
    {   
        $countryCode = request()->get('countryCode');  
        $key = config('services.api.key');

        $state = Http::get('https://geo-battuta.net/api/region/'.$countryCode.'/all/?key='.$key.'')
                   ->json();

        return $state;
    }

    public function city()
    {   
        $countryCode = request()->get('countryCode'); 
        $state = request()->get('state');  
        $key = config('services.api.key');

        $city = Http::get('http://geo-battuta.net/api/city/'.$countryCode.'/search/?region='.$state.'&key='.$key.'')
                   ->json();

        return $city;
    }
}
