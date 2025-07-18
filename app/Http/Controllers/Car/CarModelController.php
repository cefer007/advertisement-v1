<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;


class CarModelController extends Controller
{
    public function getByCarId($car_id)
    {
        $models = CarModel::query()
            ->select('id','name')
            ->where('car_id',$car_id)
            ->whereNull('deleted_by')
            ->orderBy('name')
            ->get();

        return response($models);
    }
}
