<?php

namespace App\Http\Controllers;

use App\City;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Support\Facades\Log;



class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $cities = City::All();
//        foreach ($cities as $city){
//
////            $client = new Client();
////            $api_response = $client->get('http://api.openweathermap.org/data/2.5/weather?q=Vilnius&appid=7105908275f8e7cc2d30247fc545779c');
////            $weather = json_encode($api_response);
//            $lowm = new LaravelOWM();
//            $current_weather = $lowm->getCurrentWeather($city->name);
//            $weather= json_encode($current_weather);
//            return view('cities', compact('weather'));
//        }
////        return view('cities',compact('cities'));

        $cities = City::All();
        foreach ($cities as $city) {
            $cityinfo = $this->getWeatherInformation($city->name);
            return view("cities", compact('cityinfo'));
        }
    }

    private function getWeatherInformation($city){
        $client = new Client();
            $api_response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=7105908275f8e7cc2d30247fc545779c');
            $body = json_decode($api_response->getBody() , true);
            return $body;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $city = new City();
        $city->name = $request->name;
        $city->save();
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
