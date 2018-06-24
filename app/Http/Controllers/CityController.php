<?php

namespace App\Http\Controllers;

use App\City;
use App\Weather;
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
//        $i=0;
//        $cities = City::All();
//        foreach ($cities as $city) {
//            $weathers[$i] = $this->getWeatherInformation($city->name);
//            $i++;
//
//        }
//        
//        return view("cities", compact('weathers'));
        
        $i=0;
        $cities = City::All();
        foreach ($cities as $city) {
            $api_response = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city->name . '&appid=7105908275f8e7cc2d30247fc545779c&units=metric');
            $weathers[$i] = json_decode($api_response);
            $i++;
        }
        return view("cities", compact('weathers'));

    }

    private function getWeatherInformation($city){
            $client = new Client();
            $api_response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=7105908275f8e7cc2d30247fc545779c');
            $body = json_decode($api_response->getBody() , true);
            Log::debug($body);
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
