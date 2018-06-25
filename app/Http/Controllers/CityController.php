<?php

namespace App\Http\Controllers;

use App\City;
use App\Weather;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Gmopx\LaravelOWM\LaravelOWM;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $i=0;
        $cities = City::All();
        foreach ($cities as $city) {
            $api_response = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city->name . '&appid='.$city->api_token.'&units=metric');
            $weathers[$i] = json_decode($api_response);
            $i++;
        }
        return view("cities", compact('weathers'));

    }
    
    public function refresh(){
        $i=0;
        $cities = City::All();
        foreach ($cities as $city) {
            $api_response = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city->name . '&appid='.$city->api_token.'&units=metric');
            $weathers[$i] = json_decode($api_response);
            $i++;
        }
        return view("data", compact('weathers'));       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'api_key' => 'required'
        ]);
//        Log::debug($validator);

        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $data=0;
        $cities = City::All();
        foreach ($cities as $city) {
            if($city->name==$request->city){
                $data++;
            }
        }

        if($data==0){
            $city = new City();

            $file = 'http://api.openweathermap.org/data/2.5/weather?q=' . $request->city . '&appid='.$request->api_key.'&units=metric';
            $file_headers = @get_headers($file);
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 401 Unauthorized') {
                return response()->json(['error'=>'Invalid API key!']);
            }else if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'){
                return response()->json(['error'=>'City not found!']);
            }


            $city->name = $request->city;
            $city->api_token = $request->api_key;
            $city->save();
            return response()->json(['success'=>'City is successfully added']);
        }
        return response()->json(['error'=>'City already exists!']);

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
