<?php

namespace App\Http\Controllers\dashboard\carModel;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Support\Facades\Request;

class CarModelQueryController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $models = CarModel::query()
            ->from('car_models as cm')
            ->select(
                'cm.id',
                'cm.name',
                'u.name as creator',
                'c.name as car',
                'cm.created_at',
            )
            ->join('users as u', 'u.id', '=', 'cm.created_by')
            ->join('cars as c', 'c.id', '=', 'cm.car_id')
            ->whereNull('cm.deleted_at');

        if ($request->name != null) {
            $models = $models
                ->where('cm.name', 'like',"%$request->name%");
        }
        if ($request->car_id != null) {
            $models = $models
                ->where('cm.car_id', $request->car_id);
        }


            $models = $models
                ->orderByDesc('cm.id')
                ->paginate(10);

            $cars = Car::query()
            ->whereNull('deleted_at')
            ->OrderBy('name')
            ->get();


        return view('dashboard.carmodel.index',compact('models','cars'));
    }

    public function create()
    {
        $cars = Car::query()
            ->whereNull('deleted_at')
            ->OrderBy('name')
            ->get();

        return view('dashboard.carmodel.create',compact('cars'));
    }

    public function edit($id)
    {
        $car = Car::query()
            ->from('Cars as c')
            ->where('c.id' , $id)
            ->first();

        if(!$car){
            abort('404');
        }
        return view('dashboard.car.edit',compact('car'));
    }

    public function trash(\Illuminate\Http\Request $request)
    {
        $cars = Car::query()
            ->from('Cars as c')
            ->select('c.id',
                'c.name',
                'c.created_at',
                'u.name as creator')
            ->join('users as u', 'u.id' ,  'c.created_by')
            ->whereNotNull('c.deleted_at');


        if($request->name != null)
        {
            $cars = $cars
                ->where('c.name', 'like', '%'.$request->name.'%');
        }

        if($request->creator != null)
        {
            $cars = $cars
                ->where('u.name', 'like', '%'.$request->creator.'%');
        }


        $cars = $cars
            ->orderBy('c.id', 'desc')
            ->paginate(10);

        return view('dashboard.car.trash',compact('cars'));
    }
}
