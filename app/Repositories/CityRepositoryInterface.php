<?php

namespace App\Repositories;


interface CityRepositoryInterface
{
    public function getAll();

    public function store($request);
}