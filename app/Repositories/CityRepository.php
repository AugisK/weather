<?php
/**
 * Created by PhpStorm.
 * User: jauniausPK
 * Date: 2018-06-25
 * Time: 16:21
 */

namespace App\Repositories;


use App\City;

class CityRepository implements CityRepositoryInterface
{
    /**
     * @var City
     */
    private $city;


    /**
     * CityRepository constructor.
     * @param City $city
     */
    public function __construct(City $city)
    {

        $this->city = $city;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->city->all();
    }

    /**
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        $this->city->name = $request->city;
        $this->city->api_token = $request->api_key;
        return $this->city->save();
    }
}