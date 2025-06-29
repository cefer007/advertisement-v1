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
        $model = CarModel::query()
            ->where('id' , $id)
            ->first();

        if(!$model){
            abort('404');
        }

        $cars = Car::query()
            ->from('Cars as c')
            ->select('c.id',
                'c.name',
                'c.created_at',
                'u.name as creator')
            ->join('users as u', 'u.id' ,  'c.created_by')
            ->get();

        return view('dashboard.carmodel.edit',compact('model','cars'));
    }

    public function trash(\Illuminate\Http\Request $request)
    {
        $models = CarModel::query()
            ->from('car_models as m')
            ->select('m.id',
                'm.name',
                'm.created_at',
                'u.name as creator')
            ->join('users as u', 'u.id' ,  'm.created_by')
            ->whereNotNull('m.deleted_at');


        if($request->name != null)
        {
            $models = $models
                ->where('m.name', 'like', '%'.$request->name.'%');
        }

        if($request->creator != null)
        {
            $models = $models
                ->where('u.name', 'like', '%'.$request->creator.'%');
        }


        $models = $models
            ->orderBy('m.id', 'desc')
            ->paginate(10);

        return view('dashboard.carmodel.trash',compact('models'));
    }
}
