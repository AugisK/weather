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
            $api_response = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city->name . '&appid=7105908275f8e7cc2d30247fc545779c&units=metric');
            $weathers[$i] = json_decode($api_response);
            $i++;
        }
        return view("cities", compact('weathers'));

    }
    
    public function refresh(){
        $i=0;
        $cities = City::All();
        foreach ($cities as $city) {
            $api_response = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city->name . '&appid=7105908275f8e7cc2d30247fc545779c&units=metric');
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
            'city' => 'required'
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
            $city->name = $request->city;
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
