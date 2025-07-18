<?php

namespace App\Http\Controllers\dashboard\car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Support\Facades\Request;

class CarQueryController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $cars = Car::query()
            ->from('Cars as c')
            ->select('c.id',
            'c.name',
            'c.created_at',
            'u.name as creator')
            ->join('users as u', 'u.id' ,  'c.created_by')
            ->whereNull('c.deleted_at');


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

        return view('dashboard.car.index',compact('cars'));
    }

    public function create()
    {
        return view('dashboard.car.create');
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
